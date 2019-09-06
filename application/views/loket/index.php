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
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/fontawesome/css/all.min.css">

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
					<li><a href="<?=base_url()?>tiket"><i class="fab fa-bitbucket"></i> Dispenser/Tiket</a></li>
					<li><a href="<?=base_url()?>antrian/pendaftaran"><i class="fas fa-chalkboard"></i> Display Antrian Pendaftaran</a></li>
					<li><a href="<?=base_url()?>antrian/poli"><i class="fas fa-chalkboard"></i> Display Antrian Poli</a></li>
					<li><a href="<?=base_url()?>antrian/apotik"><i class="fas fa-chalkboard"></i> Display Antrian Apotik</a></li>

					<li><a href="<?=base_url()?>adm/pendaftaran"><i class="fas fa-chalkboard-teacher"></i> Adm Loket Pendaftaran</a></li>
					<li><a href="<?=base_url()?>adm/poli"><i class="fas fa-chalkboard-teacher"></i> Adm Poli</a></li>
					<li><a href="<?=base_url()?>adm/apotik"><i class="fas fa-chalkboard-teacher"></i> Adm Apotik</a></li>

					<li><a href="<?=base_url()?>pengaturan"><i class="fas fa-cog"></i> Pengaturan</a></li>
					<li><a href="<?=base_url()?>master"><i class="fas fa-database"></i> Master</a></li>
					<li><a href="<?=base_url()?>laporan"><i class="fas fa-archive"></i> Laporan</a></li>

				</ul>
			</nav>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		
		</div>

	
</div>
</div>

</body>
</html>