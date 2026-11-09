<?= $this->extend('layout/backend') ?>

<?php  ?>php /* @var $dtakun1 array */ ?>
 <?= $this->section('content') ?>

 <section class="section">
          <div class="section-header">
           <!-- <h1>Blank Page</h1> -->
            <a href="<?=site_url('akun1/new')?>"class="btn btn-primary"> Add New></a>
          </div>

          <div class="section-body">
        <!-- dinamis-->
<div class="card">
                  <div class="card-header">
                    <h4>Tambah Data Akun 1</h4>
                  </div>
          <div class="card-body p-4">
                       <form action = "<?= site_url('akun1') ?>" method="post">
                        <?= csrf_field() ?>
                  <div class="form-group">
                      <label>Kode Akun 1</label>
                      <input type="text" class="form-control" name="kode_akun1" placeholder= "Kode akun 1" required> 
                    </div>
                    <div class="form-group">
                      <label>Nama Akun 1</label>
                      <input type="text" class="form-control"name="nama_akun1" placeholder="Nama Akun" required>
                    </div>
                      <div class="form-group">
                        <button type="submit"class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>
                        <button type="reset"class="btn btn-danger">Reset</button>
                    </div>
                    </form>
                  </div>
                </div><div class="card">
                    </div>
                </section>
                
                <?= $this->endSection('content') ?>   
                
                <!-- <div class="card-footer text-right">
                  <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                      </li>
                    </ul>
                  </nav>
                </div> -->
   
  