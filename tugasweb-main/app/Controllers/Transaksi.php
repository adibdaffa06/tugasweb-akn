<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAkun3;

class Transaksi extends BaseController
{
    public function index()
    {
        $data['dttransaksi'] = $this->db->table('tbl_transaksi')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('id_transaksi', 'DESC')
            ->get()
            ->getResult();

        $details = $this->db->table('tbl_nilai')
            ->select('tbl_nilai.*, akun3s.nama_akun3, tbl_status.nama_status')
            ->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3', 'left')
            ->join('tbl_status', 'tbl_status.id_status = tbl_nilai.id_status', 'left')
            ->orderBy('tbl_nilai.id_nilai')
            ->get()
            ->getResult();

        $data['detailByTransaksi'] = [];
        foreach ($details as $detail) {
            $data['detailByTransaksi'][$detail->id_transaksi][] = $detail;
        }

        return view('transaksi/index', $data);
    }

    public function new()
    {
        $data['dtakun3'] = (new ModelAkun3())->orderBy('kode_akun3')->findAll();
        $data['dtstatus'] = $this->db->table('tbl_status')->orderBy('id_status')->get()->getResult();

        return view('transaksi/new', $data);
    }

    public function create()
    {
        $receipt = trim((string) $this->request->getPost('kwitansi'));
        $date = (string) $this->request->getPost('tanggal');
        $description = trim((string) $this->request->getPost('deskripsi'));
        $journalNote = trim((string) $this->request->getPost('ketjurnal'));
        $accountCodes = (array) $this->request->getPost('kode_akun3');
        $debits = (array) $this->request->getPost('debit');
        $credits = (array) $this->request->getPost('kredit');
        $statusIds = (array) $this->request->getPost('id_status');

        $dateValue = \DateTime::createFromFormat('!Y-m-d', $date);
        if ($receipt === '' || strlen($receipt) > 4 || !$dateValue || $dateValue->format('Y-m-d') !== $date || $description === '' || $journalNote === '') {
            return redirect()->back()->withInput()->with('error', 'Lengkapi semua data transaksi. Nomor kuitansi maksimal 4 karakter.');
        }

        if (count($accountCodes) < 2 || count($accountCodes) !== count($debits) || count($accountCodes) !== count($credits) || count($accountCodes) !== count($statusIds)) {
            return redirect()->back()->withInput()->with('error', 'Transaksi harus memiliki minimal dua baris detail yang lengkap.');
        }

        $accounts = $this->db->table('akun3s')->get()->getResult();
        $validAccounts = [];
        foreach ($accounts as $account) {
            $validAccounts[(string) $account->kode_akun3] = true;
        }
        $statuses = $this->db->table('tbl_status')->get()->getResult();
        $validStatuses = [];
        foreach ($statuses as $status) {
            $validStatuses[(string) $status->id_status] = true;
        }

        $rows = [];
        $totalDebit = 0;
        $totalCredit = 0;
        foreach ($accountCodes as $index => $accountCode) {
            $accountCode = (string) $accountCode;
            $debit = trim((string) ($debits[$index] ?? ''));
            $credit = trim((string) ($credits[$index] ?? ''));
            $debit = $debit === '' ? '0' : $debit;
            $credit = $credit === '' ? '0' : $credit;
            $statusId = (string) ($statusIds[$index] ?? '');

            if (!isset($validAccounts[$accountCode]) || !isset($validStatuses[$statusId])) {
                return redirect()->back()->withInput()->with('error', 'Akun atau status pada detail transaksi tidak valid.');
            }
            if (!preg_match('/^\d{1,13}(?:\.\d{1,2})?$/D', $debit) || !preg_match('/^\d{1,13}(?:\.\d{1,2})?$/D', $credit)) {
                return redirect()->back()->withInput()->with('error', 'Nilai debit dan kredit harus berupa angka positif dengan maksimal dua angka desimal.');
            }

            $debitCents = (int) round((float) $debit * 100);
            $creditCents = (int) round((float) $credit * 100);
            if (($debitCents > 0) === ($creditCents > 0)) {
                return redirect()->back()->withInput()->with('error', 'Setiap baris harus berisi debit atau kredit, bukan keduanya.');
            }

            $totalDebit += $debitCents;
            $totalCredit += $creditCents;
            $rows[] = [
                'kode_akun3' => $accountCode,
                'debit' => number_format((float) $debit, 2, '.', ''),
                'kredit' => number_format((float) $credit, 2, '.', ''),
                'id_status' => (int) $statusId,
            ];
        }

        if ($totalDebit === 0 || $totalDebit !== $totalCredit) {
            return redirect()->back()->withInput()->with('error', 'Total debit dan kredit harus sama dan lebih besar dari nol.');
        }

        $this->db->transBegin();
        try {
            $this->db->table('tbl_transaksi')->insert([
                'kwitansi' => $receipt,
                'tanggal' => $date,
                'deskripsi' => $description,
                'ketjurnal' => $journalNote,
            ]);
            $transactionId = $this->db->insertID();

            foreach ($rows as &$row) {
                $row['id_transaksi'] = $transactionId;
            }
            unset($row);
            $this->db->table('tbl_nilai')->insertBatch($rows);

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Database transaction failed.');
            }
            $this->db->transCommit();
        } catch (\Throwable $exception) {
            $this->db->transRollback();
            log_message('error', 'Failed to save transaction: {message}', ['message' => $exception->getMessage()]);

            return redirect()->back()->withInput()->with('error', 'Transaksi gagal disimpan. Periksa kembali data dan konfigurasi database.');
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Transaksi berhasil disimpan.');
    }

    public function delete($id = null)
    {
        $deleted = $this->db->table('tbl_transaksi')->where('id_transaksi', $id)->delete();
        if (!$deleted || $this->db->affectedRows() === 0) {
            return redirect()->to(site_url('transaksi'))->with('error', 'Transaksi tidak ditemukan atau gagal dihapus.');
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Transaksi dan seluruh detailnya berhasil dihapus.');
    }
}
