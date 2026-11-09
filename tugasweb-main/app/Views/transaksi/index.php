<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Transaksi</title>
<?= $this->endSection('content') ?>  

<?php 
/** @var array $dttransaksi */
?>
<?= $this->section('content') ?>

 <section class="section">
          <div class="section-header">
           <!-- <h1>Blank Page</h1> -->
            <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary">Tambah Transaksi</a>
          </div>

         <?php if(session()->getFlashdata('success')): ?>
         <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert"> X </button>
            <?= session()->getFlashdata('success') ?>
        </div>
         </div>

          <!-- ini untuk menangkap seesion success dengan bawaan with -->
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert"> close </button>
              <?= session()->getFlashdata('error') ?>
            </div>
          </div>
        <?php endif; ?> 

          <div class="section-body">
            <div class="card">
              <div class="card-header"><h4>Daftar Transaksi</h4></div>
              <div class="card-body p-4">
                <div class="table-responsive">
                  <table class="table table-striped table-md" id="myTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kuitansi</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Keterangan Jurnal</th>
                        <th>Rincian</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dttransaksi as $key => $value) : ?>
                        <tr>
                          <td><?= $key + 1 ?></td>
                          <td><?= esc($value->kwitansi) ?></td>
                          <td><?= esc($value->tanggal) ?></td>
                          <td><?= esc($value->deskripsi) ?></td>
                          <td><?= esc($value->ketjurnal) ?></td>
                          <td>
                            <?php foreach ($detailByTransaksi[$value->id_transaksi] ?? [] as $detail) : ?>
                              <div><?= esc($detail->kode_akun3) ?> - <?= esc($detail->nama_akun3 ?? 'Akun dihapus') ?>:
                                D <?= number_format((float) $detail->debit, 2, ',', '.') ?> /
                                K <?= number_format((float) $detail->kredit, 2, ',', '.') ?>
                                (<?= esc($detail->nama_status ?? '') ?>)
                              </div>
                            <?php endforeach; ?>
                          </td>
                          <td class="text-center" style="width: 12%;">
                            <form action="<?= site_url('transaksi/' . $value->id_transaksi) ?>" method="post" id="del-<?= $value->id_transaksi ?>" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="button" class="btn btn-danger btn-small" data-confirm="Hapus transaksi beserta seluruh detailnya?" data-confirm-yes="hapus(<?= (int) $value->id_transaksi ?>)">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>

<?= $this->endSection('content') ?>
                      </div>

                  </div>

