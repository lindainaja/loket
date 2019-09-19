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
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/assets/css/video-js.css">


	<script type="text/javascript" src="<?=base_url()?>public/assets/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/axios.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/vue.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/assets/js/video.js"></script>

</head>
<body>

<div class="container-fluid" style="padding: 1.5em">
	<div class="row">
		<div class="col-md-12" style="padding: 0em 1em 1em 1em">
			<h1 class="text-left"><?=$nama_instansi?></h1>
			<p class="text-left"><?=$alamat_instansi?> Tel. <?=$telp?></p>
		</div>
	</div>
	<div class="row">

		<div class="col-md-5">
			<div class="row" style="padding-top: 5px">
				<div class="col-md-12" style="">
					<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab" aria-controls="nav-list" aria-selected="true">List Antrian Loket</a>
                                <a class="nav-item nav-link" id="nav-form-tab" data-toggle="tab" href="#nav-form" role="tab" aria-controls="nav-form" aria-selected="false">Form Register</a>
                            </div>
					     
					</div>
					</nav>
					 <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                        	<table class="table table-bordered" style="margin-top: 1px">
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
		<div class="col-md-7">
			<div class="row" id="admLoket">
				<div class="col-md-4 kotak-a">
					<h4 class="text-center kotak-title">A . <i>BPJS</i></h4>
					<p class="text-center">{{a.nomor}}</p>
					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="a.status!=1 || a.btnState!=1" @click="executeBtnProc('a','call')"><i class="fas fa-volume-up"></i> Call</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="a.status!=1" @click="executeBtnProc('a','skip')"><i class="fas fa-square"></i> Skip</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center mt1em" >
							<button class="btn btn-warning" :disabled="a.status!=1 " @click="executeBtnProc('a','register')"><i class="fas  fa-credit-card"></i> Register</button>
						</div>
						<div>&nbsp;</div>
					</div>
				</div>
				<div class="col-md-4 kotak-b">
					<h4 class="text-center kotak-title" style="background-color: rgb(46, 204, 113)">B . <i>UMUM</i></h4>
					<p class="text-center">{{b.nomor}}</p>

					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="b.status!=1 || b.btnState!=1" @click="executeBtnProc('b','call')"><i class="fas fa-volume-up"></i> Call</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="b.status!=1" @click="executeBtnProc('b','skip')"><i class="fas fa-square"></i> Skip</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center mt1em">
							<button class="btn btn-warning" :disabled="b.status!=1" @click="executeBtnProc('b','register')"><i class="fas  fa-credit-card"></i> Register</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 kotak-c">
					<h4 class="text-center kotak-title" style="background-color: #e74c3c">C . <i>LANSIA ANAK</i></h4>
					<p class="text-center">{{c.nomor}}</p>

					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="c.status!=1 || c.btnState!=1" @click="executeBtnProc('c','call')"><i class="fas fa-volume-up"></i> Call</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="c.status!=1" @click="executeBtnProc('c','skip')"><i class="fas fa-square"></i> Skip</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center mt1em">
							<button class="btn btn-warning" :disabled="c.status!=1" @click="executeBtnProc('c','register')"> <i class="fas  fa-credit-card"></i> Register</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
			<div id="audioPlayer"></div>
		</div>

	
</div>
</div>

</body>
<style type="text/css">
	.mt1em{
		margin-top: 1em;
	}
	#audioPlayer{
		position: fixed !important;
	}
	.kotak-a{
		border-top: 1px solid rgb(52, 152, 219);
	    border-right: none;
	    border-bottom: 1px solid rgb(52, 152, 219);
	    border-left: 1px solid rgb(52, 152, 219);
	    /*border-image: initial;*/
	}
	.kotak-c{
		border:solid 1px #e74c3c;
	}
	.kotak-b{
		border-top: 1px solid rgb(46, 204, 113);
	    border-right: none;
	    border-bottom: 1px solid rgb(46, 204, 113);
	    border-left: 1px solid rgb(46, 204, 113);
	}
	.kotak-title{
		background-color: rgb(52, 152, 219);
	    margin: 0 -16px;
	    padding: .2em;
	    color: #fff;
	    /*font-size: .8em;*/
	}
	.kotak-title > i{
	    font-size: .8em;

	}
	div#admLoket > div.col-md-4 > p.text-center{
		padding: .2em;
    font-size: 120%;
    min-height: 36px;
    font-weight: bold;
    margin: .2em;
	}
</style>
<script type="text/javascript">
	function extract_tts(text) {
		let textSpeech  = '';
		let textSplited = text.split('');

		$.each(textSplited,(i,j)=>{
			let t = ''+j ;
			if(t.match(/[a-zA-Z]/)){
				textSpeech += ','+t+',';

			}
			if(t.match(/[0-9]/)){
				if(t==0){
					textSpeech += ',Kosong,';

				}else{
					textSpeech += t;
				}
				
			}
		});
		console.log(textSpeech);
		return textSpeech;
	}
	function base_url(){
		return '<?=base_url()?>';
	}
	function create_loket(item){
		let ld_item = $.extend({},item);
		return ld_item;
	}
	let loket_data = {
	
	};
	function create_lkt(kode,nomor,obj){
		let lkt = {kode:kode,nomor:nomor,id:-1,status:-1,jp_id:-1,

			btnState:1 // kontrol button enabled
		};
		return $.extend(lkt,obj);
	}
	let admLoketVm = new Vue({
		el : '#admLoket',
		data:{
			lds: {},
			invalid_ld:{
				id:-1,
				nomor:'n/a',
				waktu_mulai:'-',
				slug:''
			},
			a:create_lkt('a',''),
			b:create_lkt('b',''),
			c:create_lkt('c',''),
			ttsState : 0,
			firstTime:false
		},
		methods:{
			executeBtnProc:function(kode,meth){
				let lkt = this[kode];
				let method = '_executeBtn_'+ meth;
				return this[method](lkt);
			},
			_executeBtn_call:function(lkt){
				console.log('called')
				if(this.ttsState!=0){
					console.log('dont run twice');
					return;
				}
				this.ttsState = 0;
				let kode = lkt.kode.toLowerCase();
				let self = this;
				console.log(JSON.stringify(lkt))
				let textUri = 'Nomor_Antrian_'+extract_tts(lkt.nomor);
				let url = base_url() + 'tts/speak/' + btoa(textUri);
				// axios.post(url,lkt).then((r)=>{

				// });
				// var oldPlayer = document.getElementById('aplayer');
				try{videojs('aplayer').dispose(); console.log('aplayer destroyed')}catch(e){};
				
				let source  = $('<source/>').attr('type','audio/mp3');
				let content = $('<audio></audio>').attr('id','aplayer')
												  .attr('class','video-js vjs-default-skin')
												  .attr('width','600')
												  .attr('height','600')
												  .attr('controls',true)
												  .attr('preload','auto')
												  .attr('data-setup','{"autoplay":true}')
												  .css({position:'absolut','z-index':-1,left:'-10000px',top:0})
												  .append(source); 
				$('div#audioPlayer').empty().html(content)
				.find('source').attr('src',url)
											;

				videojs('aplayer').ready(function() {
				    self[kode].btnState = 0;
				    this.play();
				    this.on('playing',()=>{

				    	
				    	console.log(self[kode].btnState)
				    });
				    this.on("ended",function(){
				    	self[kode].btnState = 1;
						this.ttsState = 1;

				    });
				    this.on("error",function(){
				    	alert('Tts Error Detected !!!');
				    	self[kode].btnState = 1;
						this.ttsState = 1;

				    });
				});
			},
			_executeBtn_skip:function(lkt){

			},
			_executeBtn_register:function(lkt){

			}
		},
		watch:{
			lds:function(n,o){
				let self = this;
				$.each(n,(i,j)=>{
					let oldJ = o[i];
					let kode = j.kode.toLowerCase();
					if(typeof self[kode] != 'undefined'){
						// self[kode] = create_lkt(kode,j.nomor,j);
						// try{
						if(self.firstTime){
								self[kode] = create_lkt(kode,j.nomor,j);

						}else{
							if( self[kode].status != 1 && self[kode].id != oldJ.id){
								self[kode] = create_lkt(kode,j.nomor,j);
								console.log(j);

							}
						}	
							
						// }
						// catch(e){

						// }
						
					}else{
						self[kode] = create_lkt(kode,j.nomor,j);
						console.log(j);

					}
				});
			}
		}
	});
	function update_list_loket(ld,firstTime) {
		let url = '<?=base_url()?>adm/loket_list';
		axios.get(url).then((r)=>{
			//console.log(r);
			let content = '';
			loket_data={};
			// let lds = {};
			$.each(r.data,(id,item)=>{
				content += '<tr><td>'+(id+1)+'</td><td>'+item.nomor+'</td><td>'+item.waktu_mulai+'</td><td>'+item.slug.toUpperCase()+'</td></tr>'
					ld
				if( typeof loket_data[item.slug] == 'undefined'){
					loket_data[item.slug] = create_loket(item);
					console.log(loket_data[item.slug]);
				}
				else if(typeof loket_data[item.slug] != 'undefined'){
					if( loket_data[item.slug].status != 1){
						loket_data[item.slug] = create_loket(item);
						console.log(loket_data[item.slug]);

					}
					
				}	
				
			});
			if(firstTime){
				admLoketVm.firstTime =true;
			}
			admLoketVm.lds=loket_data;
			$('#list_antrian_body').html(content);
		}).then((e)=>{

			
		});
	}
	$(document).ready(()=>{
		setInterval(()=>{
		 	update_list_loket(loket_data);
		 },5000);
		update_list_loket(loket_data,true);
	});
</script>
</html>