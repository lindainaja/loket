<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pengaturan</title>
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
			<h1>Pengaturan</h1>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Pengaturan</th>
						<th>Nilai</th>
						<th>Aksi</th>
						<th>Keterangan</th>
						<th>URL</th>
					</tr>
				</thead>
				<tbody>
					<?foreach($settings as $s):?>
					<tr key="<?=$s->key?>">
						<td><?=$s->name?></td>
						<td><code><?=$s->value?></code></td>
						<td><button class="btn btn-default">Default</button></td>
						<td><?=parse_setting_template($s->keterangan)?></td>
						<td><?=$s->url?></td>
					</tr>
					<?endforeach?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		
		</div>

	
</div>
</div>

</body>
</html>