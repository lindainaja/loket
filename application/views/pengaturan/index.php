<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Master</title>
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
			<h1>Master!</h1>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
			<nav class="navbar navbar-default">
				<ul class="nav navbar-nav">
					

					<li><a href="<?=base_url()?>pengaturan/jadwal_dokter">Jadwal Dokter</a></li>
					<li><a href="<?=base_url()?>pengaturan/umum">Pengaturan Umum</a></li>
					<li><a href="<?=base_url()?>pengaturan/update">Update</a></li>

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