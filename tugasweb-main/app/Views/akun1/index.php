<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Akun1</title>
<?= $this->endSection('content') ?>  

<?php /** @var array $dtakun1 */ ?>
 <?= $this->section('content') ?>

 <section class="section">
          <div class="section-header">
           <!-- <h1>Blank Page</h1> -->
            <a href="<?=site_url('akun1/new')?>"class="btn btn-primary"> add new </a>
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
        <!-- dinamis--> 
<div class="card">
                  <div class="card-header">
                    <h4>Data Akun 1</h4>
                  </div>
          <div class="card-body p-4">
                    <div class="table-responsive">
                      <table class="table table-striped table-md" id="myTable">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Kode Akun 1</th>
                        <th>Nama Akun</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                        <tbody>
                      <?php foreach ($dtakun1 as $key => $value) : ?>
                        <tr>
                          <td><?= $key + 1 ?></td>
                          <td><?= $value->kode_akun1 ?></td>
                          <td><?= $value->nama_akun1 ?></td>
                          <td class="text-center" style="width: 15%;">
                              <a href="<?=site_url('akun1/edit/' . $value->id_akun1) ?>" class="btn btn-primary"><i class="fas fa-pencil-alt btn-small"></i> Edit</a>
                              <form action="<?= site_url('akun1/' . $value->id_akun1) ?>" method="post" id="del-<?= $value->id_akun1 ?>" class="d-inline">
                                  <?= csrf_field(); ?>
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="button" class="btn btn-danger btn-small" data-confirm="Hapus Data? | Apakah anda Yakin?" data-confirm-yes="hapus(<?= $value->id_akun1 ?>)">
                                      <i class="fas fa-trash"></i> Del
                                  </button>
                              </form>
                          </form>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    
                        <!-- <tr>
                          <td>1</td>
                          <td>Mass Bagas</td>
                          <td>2017-01-09</td>
                          <td><div class="badge badge-success">Active</div></td>
                          </td>
                        </tr> -->

                  </table>
                    </div>
                  </div>
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
                </div><div class="card">
          </div>
        </section>

        <?= $this->endSection('content') ?>   
   
   
  