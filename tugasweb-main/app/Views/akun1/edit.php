<?= $this->extend('layout/backend') ?>

<?php  ?>php /* @var $dtakun1 array */ ?>
 <?= $this->section('content') ?>

 <section class="section">
          <div class="section-header">
           <!-- <h1>Blank Page</h1> -->
            <a href="<?=site_url('akun1')?>"class="btn btn-primary"> Back</a>
          </div>

          <div class="section-body">
        <!-- dinamis-->
<div class="card">
                  <div class="card-header">
                    <h4>Edit Data Akun 1</h4>
                  </div>
          <div class="card-body p-4">
                       <form action = "<?= site_url('akun1/edit/'. (isset($dtakun1) ? $dtakun1->id_akun1: ''))?>" method="post">
                       
                        <?= csrf_field() ?> 
                      <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                      <label>Kode Akun 1</label>
                      <input type="text" class="form-control" name="kode_akun1" placeholder="Kode Akun 1" required value="<?= isset($dtakun1) ? $dtakun1->kode_akun1 : '' ?>">
                    </div>
                    <div class="form-group">
                      <label>Nama Akun 1</label>
                      <input type="text" class="form-control" name="nama_akun1" placeholder="Nama Akun 1" required value="<?= isset($dtakun1) ? $dtakun1->nama_akun1 : '' ?>">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
                      <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i> Batal</button>
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
   
  