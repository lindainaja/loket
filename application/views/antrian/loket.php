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
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/video-js.css">

	<script type="text/javascript" src="<?=base_url()?>public/assets/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/clock.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/video.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/vue.min.js"></script>

</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="background: #1abc9c;padding: 1em">
			<h1 class="text-center" style="font-size: 300%"><?=$nama_instansi?></h1>
			<h4 class="text-center"><?=$alamat_instansi?></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5">
			<div style="text-align: center;margin-top:14% ">
				<h1 style="font-size: 1024%">A002</h1>
			</div>
			
		</div>
		<div class="col-md-7" style="overflow: hidden;">
			<video
			 id="my-player"
			 class="video-js"
			 style="height:450px"
			 muted
			 preload="auto"
			 poster="<?=base_url()?>public/assets/videos/oceans.png"
			 data-setup='{"loop": true,"autoplay":true}'>
			 <source src="<?=base_url()?>public/assets/videos/oceans.mp4" type="video/mp4"></source>
			 <p class="vjs-no-js">
			 To view this video please enable JavaScript, and consider upgrading to a web browser that
			 supports HTML5 video
			  
			 </p>
			</video>
		</div>
	</div> 
	<div class="row" style="position: fixed;bottom: 0;width:100%">
		<div class="col-md-4" style="background-color: #3498db;;padding-top: 1em;padding-bottom: 0.5em">
			<div class="text-center">
				<h2 style="font-size :300%">A.UMUM</h2>
				<h2 style="font-size :500%">10</h2>

			</div>
			
		</div>
		<div class="col-md-4" style="background-color: #2ecc71;padding-top: 1em;padding-bottom: 0.5em">
			<div class="text-center">
				<h2 style="font-size :300%">B.BPJS</h2>
				<h2 style="font-size :500%">5</h2>
				
			</div>
		</div>
		<div class="col-md-4"  style="background-color: #e74c3c;padding-top: 1em;padding-bottom: 0.5em">
			<div class="text-center">
				<h2 style="font-size :300%">C.LANSIA/ANAK</h2>
				<h2 style="font-size :500%">10</h2>
				 
			</div>
		</div>
	</div> 

</div>

</body>
<script type="text/javascript">
	$(document).ready(()=>{
		// create_clock('#clock');
		 // $('button.vjs-big-play-button').click() ;

		 
	});

</script>
</html>