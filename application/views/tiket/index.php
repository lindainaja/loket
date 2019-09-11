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
					<li><a class="prnt-ifr" href="<?=base_url()?>tiket/cetak/<?=$jp->slug?>"><?=$jp->nama?></a></li>
					<?endforeach?>
				</ul>
			</nav>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		<iframe src="" id="iframeCetak"></iframe>
		</div>

	
</div>
</div>

</body>
<script type="text/javascript">
	$(document).ready(() => {
		$('a.prnt-ifr').click(()=>{
			var url = $(event.target).prop('href');
			console.log(url)
			$('#iframeCetak').prop('src',url);
			return false;
		});
		$('#iframeCetak').on('load',() => {
		    console.log('load the iframe')
		    let cw = $('#iframeCetak').get(0).contentWindow;
		    if(cw.document.title === 'OK_PRINT'){
		    	cw.print();
		    };
		    //the console won't show anything even if the iframe is loaded.
		})
	});	
</script>
</html>