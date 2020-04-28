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

  <script type="text/javascript" src="<?php echo base_url('assets/datatable/datatable.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/datatable/datatable.min.js') ?>"></script>
  <style type="text/css">
    
  </style>

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand bg-light" style="border-radius: 5px; padding: 2px;" href="#">SRD LAUNDRY</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto bg-white">
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('App_controler/CTampilMember') ?>">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('App_controler/CTampilService')?>">Service</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?= site_url('App_controler/CTampilKeranjang')?>">Keranjang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('App_controler/CTampilPembayaran')?>">Pembayaran</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('App_controler/CTampilLaporan')?>">Laporan</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-danger ml-1" href="<?= site_url('App_controler/Clogout')?>">Logout</a>
    </form>
  </div>
</nav>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>