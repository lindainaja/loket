<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Antrilah di Loket!</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-reboot.min.css">

	<script type="text/javascript" src="<?=base_url()?>public/assets/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Welcome to Loket!</h1>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
			<nav class="navbar navbar-default">
				<ul class="nav navbar-nav">
					<li><a href="<?=base_url()?>tiket">Dispenser/Tiket</a></li>
					<li><a href="<?=base_url()?>antrian/pendaftaran">Display Antrian Pendaftaran</a></li>
					<li><a href="<?=base_url()?>antrian/poli">Display Antrian Poli</a></li>
					<li><a href="<?=base_url()?>antrian/apotik">Display Antrian Apotik</a></li>

					<li><a href="<?=base_url()?>adm/pendaftaran">Adm Loket Pendaftaran</a></li>
					<li><a href="<?=base_url()?>adm/poli">Adm Poli</a></li>
					<li><a href="<?=base_url()?>adm/apotik">Adm Apotik</a></li>

					<li><a href="<?=base_url()?>pengaturan">Pengaturan</a></li>

				</ul>
			</nav>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
		</div>

	
</div>
</div>

</body>
</html>