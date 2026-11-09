<?= $this->extend('layout/backend') ?>

<?php /** @var array $dtakun3 */ ?>
<?php /** @var array $dtstatus */ ?>
<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('transaksi') ?>" class="btn btn-primary">Kembali</a>
  </div>
  <div class="section-body">
    <?php if ($error = session()->getFlashdata('error')) : ?>
      <div class="alert alert-danger"><?= esc($error) ?></div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header"><h4>Tambah Transaksi</h4></div>
      <div class="card-body p-4">
        <form action="<?= site_url('transaksi') ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="kwitansi">Nomor kuitansi</label>
              <input id="kwitansi" type="text" class="form-control" name="kwitansi" maxlength="4" required value="<?= esc(old('kwitansi')) ?>">
            </div>
            <div class="form-group col-md-4">
              <label for="tanggal">Tanggal</label>
              <input id="tanggal" type="date" class="form-control" name="tanggal" required value="<?= esc(old('tanggal', date('Y-m-d'))) ?>">
            </div>
            <div class="form-group col-md-4">
              <label for="ketjurnal">Keterangan jurnal</label>
              <input id="ketjurnal" type="text" class="form-control" name="ketjurnal" maxlength="100" required value="<?= esc(old('ketjurnal')) ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" class="form-control" name="deskripsi" rows="2" required><?= esc(old('deskripsi')) ?></textarea>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Rincian jurnal</h5>
            <button type="button" class="btn btn-outline-primary" id="add-row"><i class="fas fa-plus"></i> Tambah baris</button>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="detail-table">
              <thead>
                <tr>
                  <th>Akun</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($rowIndex = 0; $rowIndex < 2; $rowIndex++) : ?>
                  <tr>
                    <td>
                      <select class="form-control" name="kode_akun3[]" required>
                        <option value="">Pilih akun</option>
                        <?php foreach ($dtakun3 as $account) : ?>
                          <option value="<?= esc($account->kode_akun3) ?>" <?= old('kode_akun3.' . $rowIndex) == $account->kode_akun3 ? 'selected' : '' ?>>
                            <?= esc($account->kode_akun3 . ' - ' . $account->nama_akun3) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input class="form-control" type="number" name="debit[]" min="0" step="0.01" value="<?= esc(old('debit.' . $rowIndex)) ?>" placeholder="0.00"></td>
                    <td><input class="form-control" type="number" name="kredit[]" min="0" step="0.01" value="<?= esc(old('kredit.' . $rowIndex)) ?>" placeholder="0.00"></td>
                    <td>
                      <select class="form-control" name="id_status[]" required>
                        <?php foreach ($dtstatus as $status) : ?>
                          <option value="<?= esc($status->id_status) ?>" <?= old('id_status.' . $rowIndex) == $status->id_status || (!old('id_status.' . $rowIndex) && $status->nama_status === 'Normal') ? 'selected' : '' ?>><?= esc($status->nama_status) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-row" aria-label="Hapus baris"><i class="fas fa-trash"></i></button></td>
                  </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan transaksi</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  const detailBody = document.querySelector('#detail-table tbody');
  document.querySelector('#add-row').addEventListener('click', () => {
    const row = detailBody.rows[0].cloneNode(true);
    row.querySelectorAll('input').forEach((input) => { input.value = ''; });
    row.querySelectorAll('select').forEach((select) => { select.selectedIndex = 0; });
    detailBody.appendChild(row);
  });

  detailBody.addEventListener('click', (event) => {
    const removeButton = event.target.closest('.remove-row');
    if (removeButton && detailBody.rows.length > 2) {
      removeButton.closest('tr').remove();
    }
  });
</script>

<?= $this->endSection('content') ?>