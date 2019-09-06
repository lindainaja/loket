<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tiket</title>
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
			<h1>Tiket</h1>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
			<nav class="navbar navbar-default">
				<ul class="nav navbar-nav">
					<?foreach($jenis_pendaftaran as $jp):?>
					<li><a href="<?=base_url()?>tiket/cetak/<?=$jp->slug?>"><?=$jp->nama?></a></li>
					<?endforeach?>
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