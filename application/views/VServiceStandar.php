<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.min.css') ?>">
    <style type="text/css">

    </style>
</head>
<body>

<?php if ($this->session->has_userdata('username')): ?>


    <div class="container-fluid">

      <div class="row mt-5 ml-4">
        <?php foreach($data as $d) :?>
          <?= form_open('App_controler/CMasukKeranjang/'.$d['id_paket'], ['method' => 'POST']) ?>
            <div class="col-lg-3" style="padding: 17px;">
              <div class="card bg-danger" style="width: 18rem; color: white;">
                <img class="card-img-top" src="<?= base_url('assets/image/'.$d['gambar_paket']) ?>" alt="286 x 180"> 
                <div class="card-body">
                  <h5 class="card-title"><?= $d['nm_paket'] ?> Harga : <?= number_format($d['harga_paket'], 2, ',', '.') ?> </h5>
                  <p class="card-text"><?= $d['deskripsi_paket'] ?></p>
                  <input type="number"  name="kuantitas" value="1" class="form-control mb-2">
                  <input type="submit" class="btn btn-dark" value="Keranjang">
                </div>
              </div>
            </div>
            <?= form_close() ?>
        <?php endforeach ?>
      </div>

    </div>


  
<?php else: ?>
  <?php $this->load->view('Vlogin') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>