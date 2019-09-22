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

		<div class="col-md-6">
			<div class="row" style="padding-top: 5px">
				<div class="col-md-12" style="">
					<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist" style="border-bottom: none;">
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
										<th>STATUS</th>
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
			<div class="row" id="admLoket" style="margin-top: 9px">
				<div class="col-md-4 kotak-a">
					<h4 class="text-center kotak-title">A . <i>BPJS</i></h4>
					<p class="text-center">{{a.nomor}}</p>
					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="a.status!=1 || a.btnCallState!=1" @click="executeBtnProc('a','call')"><i class="fas fa-volume-up"></i> Call <span>{{a.callAttempt}}</span></button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="a.btnSkipState!=1" @click="executeBtnProc('a','skip')"><i class="fas fa-square"></i> Skip</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center mt1em" >
							<button class="btn btn-warning" :disabled="a.btnRegisterState!=1 " @click="executeBtnProc('a','register')"><i class="fas  fa-credit-card"></i> Register</button>
						</div>
						<div>&nbsp;</div>
					</div>
				</div>
				<div class="col-md-4 kotak-b">
					<h4 class="text-center kotak-title" style="background-color: rgb(46, 204, 113)">B . <i>UMUM</i></h4>
					<p class="text-center">{{b.nomor}}</p>

					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="b.status!=1 || b.btnCallState!=1" @click="executeBtnProc('b','call')"><i class="fas fa-volume-up"></i> Call <span v-text="'('+b.callAttempt+')'"></button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="b.btnSkipState!=1" @click="executeBtnProc('b','skip')"><i class="fas fa-square"></i> Skip</button>
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
							<button class="btn btn-primary" :disabled="c.status!=1 || c.btnCallState!=1" @click="executeBtnProc('c','call')"><i class="fas fa-volume-up"></i> Call</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" :disabled="c.btnSkipState!=1" @click="executeBtnProc('c','skip')"><i class="fas fa-square"></i> Skip</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center mt1em">
							<button class="btn btn-warning" :disabled="c.btnRegisterState!=1" @click="executeBtnProc('c','register')"> <i class="fas  fa-credit-card"></i> Register</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
			<div id="audioPlayer">
				<audio id="aplayer" class="video-js vjs-default-skin" width="100" height="50" controls="controls" preload="auto" data-setup='{"autoplay":false}'>
					<source src="http://127.0.0.1/loket/tts/speak/Tm9tb3JfQW50cmlhbl8sQSwsS29zb25nLCxLb3NvbmcsLEtvc29uZywx?q=1569117054848" type="audio/mp3"/>
					</audio>
			</div>
		</div>

	
</div>
</div>

</body>
<style type="text/css">
	.mt1em{
		margin-top: 1em;
	}
	#audioPlayer{
		width: 200px;
	    height:80px;
	    position: absolute;
	    top: 0;
	    overflow: hidden;
	    opacity: .5;
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
	function create_loket(item,obj){
		// let ld_item = $.extend({},item);
		// return ld_item;
		if(typeof obj == 'undefined'){
			obj = {};
		}
		// console.log('obj:'+JSON.stringify(obj));

		$.each(item,(i,j)=>{
			if(typeof obj[i] == 'undefined'){
				obj[i] = j;
			}
		});
		// console.log('item:'+JSON.stringify(item));
		// return obj;
		return $.extend({},obj);
	}
	let loket_data = {
	
	};
	function create_lkt(kode,nomor,obj){
		let lkt = {kode:kode,nomor:nomor,id:-1,status:-1,jp_id:-1,

			
		 
			btnCallState:1,
			btnSkipState:0,
			btnRegisterState:0,
			callAttempt:0 // kontrol button enabled
		}
		// if(typeof addBtState != 'undefined'){
		// 	lkt = $.extend(lkt,btState);
		// }
		if(typeof obj == 'undefined'){
			obj = {};
		}
		$.each(lkt,(i,j)=>{
			if(typeof obj[i] == 'undefined'){
				obj[i] = j;
			}
		});

		return obj;
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
			firstTime:false,
			lastPlayerId:'',
			lastPlayAttempt:0,
			currentCode : ''
		},
		methods:{
			onUpdatePlayerState:function(state){
				let self = this;
				let kode = this.currentCode;
				console.log(kode);

				self[kode].btnCallState = 0;

				switch(state){
					case 'playing':
				    	console.log('self['+kode+'].btnCallState='+self[kode].btnCallState);
					break;
					case 'ended':
						self[kode].btnCallState = 1;
						self.ttsState = 0;
						self.lastPlayAttempt = 0;

						//
						self[kode].btnRegisterState =1;
						self[kode].callAttempt +=1;

						if(self[kode].callAttempt >= 3){
							self[kode].btnSkipState = 1;
						}
						
						console.log(JSON.stringify(self[kode]));
					break;
					case 'error':
						self[kode].btnCallState = 1;
						self.ttsState = 0;
						if(self.lastPlayAttempt<3){
							setTimeout(()=>{
								self._executeBtn_call(lkt);
								self.lastPlayAttempt += 1;
							},500);
							
						}else{
							console.log('Tts Error Detected !!!');
						}
					break;
				}
			},
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
				this.currentCode = kode;
				let self = this;
				console.log(JSON.stringify(lkt))
				let textUri = 'Nomor_Antrian_'+extract_tts(lkt.nomor);
				let url = base_url() + 'tts/speak/' + btoa(textUri)+'/audio.mp3?q='+(new Date()).getTime();

				videojs('aplayer').loadMedia({src:url});
				videojs('aplayer').play();
				// axios.post(url,lkt).then((r)=>{

				// });
				
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
						
						// 
						// console.log('--------------------CREATE LKT UPDATE---------------------------');

						if(self.firstTime){
								self[kode] = create_lkt(kode,j.nomor,j,true);
								// self.firstTime = false;
								// console.log(j);
								// console.log(oldJ);

						}else{
							if( self[kode].status != 1 && self[kode].id != oldJ.id){
								self[kode] = create_lkt(kode,j.nomor,j);
								console.log(j);
								console.log(oldJ);

							}
						}	
							
						// }
						// catch(e){

						// }
						
					}else{
						console.log('--------------------CREATE LKT NEW---------------------------');

						self[kode] = create_lkt(kode,j.nomor,j,true);
						console.log(j);

					}
				});
				return n;
			}
		}
	});
	function update_list_loket(ld,firstTime) {
		let url = '<?=base_url()?>adm/loket_list';
		axios.get(url).then((r)=>{
			//console.log(r);
			let content = '';
			let loket_data= {};
			// let lds = {};
			if(r.data.length == 0){
				content += '<tr><td colspan="5">Belum ada data antrian</td></tr>';

			}
			$.each(r.data,(id,item)=>{
				content += '<tr><td>'+(id+1)+'</td><td>'+item.nomor+'</td><td>'+item.waktu_mulai+'</td><td>'+item.slug.toUpperCase()+'</td><td>'+item.status+'</td></tr>'
					ld
				if( typeof loket_data[item.slug] == 'undefined'){
					loket_data[item.slug] = create_loket(item,admLoketVm.lds[item.slug]);
					// console.log(loket_data[item.slug]);
				}
				else if(typeof loket_data[item.slug] != 'undefined'){
					if( loket_data[item.slug].status != 1){
						loket_data[item.slug] = create_loket(item,admLoketVm.lds[item.slug]);
						// console.log(loket_data[item.slug]);

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
		 },2000);
		update_list_loket(loket_data,true);
		let player  = videojs('aplayer');

		player.on('playing',()=>{
		    	admLoketVm.onUpdatePlayerState('playing');
		    });
		    player.on("ended",function(){
		    	admLoketVm.onUpdatePlayerState('ended');
		    });
		    player.on("error",function(){
		    	admLoketVm.onUpdatePlayerState('error');
		    });
	});
</script>
</html>