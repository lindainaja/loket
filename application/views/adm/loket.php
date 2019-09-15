<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Adm Loket</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/fontawesome/css/all.min.css">

	<script type="text/javascript" src="<?=base_url()?>public/assets/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/axios.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/vue.min.js"></script>

</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="background-color: #dedede">
			<h1 class="text-center"><?=$nama_instansi?></h1>
			<p class="text-center"><?=$alamat_instansi?> Tel. <?=$telp?></p>
		</div>
	</div>
	<div class="row">

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab" aria-controls="nav-list" aria-selected="true">List Antrian Loket</a>
                                <a class="nav-item nav-link" id="nav-form-tab" data-toggle="tab" href="#nav-form" role="tab" aria-controls="nav-form" aria-selected="false">Form Pendaftaran</a>
                            </div>
					     
					</div>
					</nav>
					 <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                        	<table class="table table-stripped">
								<thead>
									<tr>
										<th>#</th>
										<th>NOMOR</th>
										<th>WAKTU AMBIL TIKET</th>
										<th>JENIS</th>
									</tr>
								</thead>
								<tbody id="list_antrian_body">
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <div class="tab-pane" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab">
                        </div>
                     </div>           
					 
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4" style="padding: 0;border:solid 1px #3498db;border-right: none;">
					<h4 class="text-center" style="background-color: #3498db;margin: 0">A.UMUM</h4>
					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary"><i class="fas fa-volume-up"></i> Panggil</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger"><i class="fas fa-square"></i> Lewat</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-warning"><i class="fas  fa-credit-card"></i> Pendaftaran</button>
						</div>
						<div>&nbsp;</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 0;border: solid 1px #2ecc71;border-right: none">
					<h4 class="text-center" style="background-color: #2ecc71;margin: 0">B.BPJS</h4>
					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-default"><i class="fas fa-volume-up"></i> Panggil</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-default"><i class="fas fa-square"></i> Lewat</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-default"><i class="fas  fa-credit-card"></i> Pendaftaran</button>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding:0;border:solid 1px #e74c3c">
					<h4 class="text-center" style="background-color: #e74c3c;margin: 0">C.LANSIA/ANAK</h4>
					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-default"><i class="fas fa-volume-up"></i> Panggil</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-default"><i class="fas fa-square"></i> Lewat</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-default"><i class="fas  fa-credit-card"></i> Pendaftaran</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		
		</div>

	
</div>
</div>

</body>
<script type="text/javascript">
	$(document).ready(()=>{
		// setInterval(()=>{
		//  	document.location = document.location
		//  },5000);
	});
</script>
</html>