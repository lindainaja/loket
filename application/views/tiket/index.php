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
	<div class="row headerT">
		<div class="col-md-12" style="padding-left: 3em">
			<h2 style="margin:0 "><?=$nama_instansi?></h2>
			<p style="margin:0 "><?=$alamat_instansi?> Telp.<?=$tlp_instansi?></p>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12">
			<p class="bantuan">
				Untuk mendapatkan nomor antrian sesuai dengan pilihan anda silahkan tekan tombol berikut:
			</p>
			<nav class="navbar navbar-default">
				<ul class="nav navbar-nav" style="width: 100%">
					<?foreach($jenis_pendaftaran as $jp):?>
					<?$btn=['bpjs'=>'primary','umum'=>'success','lansia-anak'=>'danger'][$jp->slug]?>
					<li style="margin:4px"><button class="btn btn-<?=$btn?> prnt-ifr <?=$jp->slug?>" href="<?=base_url()?>tiket/cetak/<?=$jp->slug?>"><?=$jp->kode?> : <?=$jp->nama?></button></li>
					<?endforeach?>
				</ul>
			</nav>
		</div>
	</div>
	<div class="row d footer">
		<div class="col-md-12 row-a" style="color: #fff;padding:1em 1em 1em 3em">
			<h4 class="" style="font-size: 100%;margin:2px">Sistem Informasi Antrian</h4>
			<small class="">Copyright &copy; 2019 Agung Rizky Tiga </small>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
		<iframe src="" id="iframeCetak" style=""></iframe>
		</div>

	
</div>

</div>
</div>

</body>
<style type="text/css">
	.row.d.footer{
		background:#34495e; 
		color: #fff;
		padding: .5em 0;
		position: fixed;
		bottom: 0;
		width: 100%;
	}
	#iframeCetak{
		width: 1px;
	    height:1px;
	    position: absolute;
	    top: 0;
	    overflow: hidden;
	    opacity: .5;
	}
	button.prnt-ifr{
		width: 56%;
	    text-align: left;
	    font-size: 2em;
	    margin: 8px;
	    padding: .5em;
	}
	.bantuan{
	    margin: 1em 1em 0em 2em;
	    display: block;
	    width: 484px;
	}
	/*button.prnt-ifr.bpjs{
		background: #3498db;
		border-color: #3498db;
	}*/
	body{
		background: #eee;
	}
	.headerT{
		background:#34495e; 
		color: #fff;
		padding: 1em 0;
	}
</style>
<script type="text/javascript">
	$(document).ready(() => {
		$('button.prnt-ifr').click(()=>{
			let btn = $(event.target);
			var url = btn.attr('href');
			// console.log(url)
			btn.attr('disabled',true);
			setIFrameSrc('iframeCetak', url, btn);
			return false;
		});
		

		function setIFrameSrc(idFrame, url, btn) {
		    var originalFrame = document.getElementById(idFrame);
		    var newFrame = document.createElement("iframe");
		    newFrame.id = originalFrame.getAttribute("id");
		    newFrame.width = originalFrame.getAttribute("width");
		    newFrame.height = originalFrame.getAttribute("height");
		    newFrame.src = url;    
		    var parent = originalFrame.parentNode;
		    parent.replaceChild(newFrame, originalFrame);

		    $('#'+idFrame).on('load',() => {
			    console.log('load the iframe')
			    let cw = $('#'+idFrame).get(0).contentWindow;
			    if(cw.document.title === 'OK_PRINT'){
			    	cw.print();
			    	setTimeout(()=>{
			    		setIFrameSrc(idFrame, '');
						btn.attr('disabled',false);

			    	},3000);
			    }else{
			    	//alert($(cw.document.body).text());
					btn.attr('disabled',false);

			    };
			    //the console won't show anything even if the iframe is loaded.
			});
		}
	});	
</script>


</html>