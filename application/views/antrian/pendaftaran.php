<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$app_name?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/fontawesome/css/all.min.css">

	<script type="text/javascript" src="<?=base_url()?>public/assets/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/clock.js"></script>

</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><?=$nama_instansi?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered table-hover">
				<!-- <thead>
					<tr><th>NOMOR ANTRIAN</th></tr>
				</thead> -->
				<tbody>
					<tr><td>ANTRIAN UMUM</td> 
					 <td>A0001</td> 
					 <td>09:00:00
					</tr>
					<tr><td>ANTRIAN BPJS</td> 
					 <td>B0001</td> 
					 <td>09:00:00
					</tr>
					<tr><td>ANTRIAN LANSIA/ANAK</td> 
					 <td>C0001</td> 
					 <td>-
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered">
				<thead>
					<tr><th>NOMOR ANTRIAN</th></tr>
				</thead>
				<tbody>
					<tr><td><h1><span id="nomor_antrian">A0001</span></h1></td></tr>
					<tr><td><span id="nama_loket">Loket 1</span></td></tr>
					<tr><td><i class="fas fa-volume-up"></i> Call</td></tr>
				</tbody>
			</table>
		</div>
	</div> 
	<div class="row">
		<div class="col-md-10">
			<marquee> Selamat Datang di <?=$nama_instansi?></marquee>
		</div>
		<div class="col-md-2">
			<div id="clock"></div>
		</div>
	</div> 

</div>

</body>
<script type="text/javascript">
	$(document).ready(()=>{
		create_clock('#clock');
	});
</script>
</html>