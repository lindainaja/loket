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
	<script type="text/javascript" src="<?=base_url()?>public/assets/grocery_crud/themes/flexigrid/js/cookies.js"></script>

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
                        	<form class="form-horizontal" style="padding-top: 1em" action="javascript:;">
                        		<div class="form-group row">
                        			<label class="col-md-3 text-right">No. Antrian</label>
                        			<div class="col-md-6">
                        				<input type="text" disabled v-model="form.nomor" name="nomor" class="form-control" />
                        				<input type="hidden" v-model="form.id_antrian" name="id_antrian" class="form-control" />
                        			</div>
                        		</div>
                        		<div class="form-group row">
                        			<label class="col-md-3 text-right">Nama Pasien</label>
                        			<div class="col-md-8">
                        				<input type="text" :disabled="form.id_antrian==''" v-model="form.nama" name="nama" class="form-control" />
                        			</div>
                        		</div>
                        		<div class="form-group row">
                        			<label class="col-md-3 text-right">Alamat Pasien</label>
                        			<div class="col-md-8">
                        				<input type="text" :disabled="form.id_antrian==''" v-model="form.alamat" name="alamat" class="form-control" />
                        			</div>
                        		</div>
                        		<div class="form-group row">
                        			<label class="col-md-3 text-right">Poli Tujuan</label>
                        			<div class="col-md-8">
                        				<?=$dd_poli?>
                        			</div>
                        			<input type="hidden" name="nama_poli" v-model="form.nama_poli">
                        			<input type="hidden" name="dt" v-model="form.dt">
                        		</div>
                        		<div class="form-group row">
                        			<div class="col-md-3"></div>
                        			<div class="col-md-8 text-right">
                        				<button class="btn btn-success" :disabled="invalidForm()" @click="doRegisterForm()"><i class="fas fa-check"></i> Finish</button>
                        			</div>
                        		</div>
                        	</form>
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
							<button class="btn btn-primary" :disabled="a.status!=1 || a.btnCallState!=1" @click="executeBtnProc('a','call')"><i class="fas fa-volume-up"></i> Call <span>({{a.callAttempt}})</span></button>
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
							<button class="btn btn-warning" :disabled="b.btnRegisterState!=1" @click="executeBtnProc('b','register')"><i class="fas  fa-credit-card"></i> Register</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 kotak-c">
					<h4 class="text-center kotak-title" style="background-color: #e74c3c">C . <i>LANSIA ANAK</i></h4>
					<p class="text-center">{{c.nomor}}</p>

					<div class="row" style="padding: .5em">
						<div class="col-md-6">
							<button class="btn btn-primary" :disabled="c.status!=1 || c.btnCallState!=1" @click="executeBtnProc('c','call')"><i class="fas fa-volume-up"></i> Call <span v-text="'('+c.callAttempt+')'"></span></button>
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
		width: 1px;
	    height:1px;
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
	function mysql_now(){
		return (new Date ((new Date((new Date(new Date())).toISOString() )).getTime() - ((new Date()).getTimezoneOffset()*60000))).toISOString().slice(0, 19).replace('T', ' ');
	}
 

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
		if(typeof obj != 'object'){
			obj = {};
		}
		$.each(lkt,(i,j)=>{
			if(typeof obj[i] == 'undefined'){
				obj[i] = j;
			}
		});

		return $.extend({},obj);
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
						
						self._updateCookieRow(self[kode].id,{
							callAttempt:self[kode].callAttempt,
						});

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
				// console.log('called')
				if(this.ttsState!=0){
					console.log('dont run twice');
					return;
				}
				this.ttsState = 0;
				let kode = lkt.kode.toLowerCase();
				this.currentCode = kode;
				let self = this;
				// console.log(JSON.stringify(lkt))
				let textUri = 'Nomor_Antrian_'+extract_tts(lkt.nomor);
				let url = base_url() + 'tts/speak/' + btoa(textUri)+'/audio.mp3?q='+(new Date()).getTime();

				videojs('aplayer').loadMedia({src:url});
				videojs('aplayer').play();
				// axios.post(url,lkt).then((r)=>{

				// });
				
			},
			_executeBtn_skip:function(lkt){
				console.log('called')
				let self = this;
				let kode = lkt.kode.toLowerCase();
				let url = base_url() + 'adm/loket_skip/' + lkt.id;
				// this.currentCode = kode;

				axios.get(url).then(()=>{
					console.log(lkt.id+':skipped');
					// lkt.status = 3;
					self[kode] = create_lkt(kode,'');
					self.lds[lkt.slug] = create_lkt(kode,'');
				});
				console.log(url)

			},
			_executeBtn_register:function(lkt){
				// activate form tab
				$('#nav-form-tab').click();
				frmRegVm.setFormData(lkt);
				console.log(lkt)
			},
			_afterRegister: function(lkt){
				let self = this;
				let kode = lkt.kode.toLowerCase();
				
				self[kode] = create_lkt(kode,'');
				self.lds[lkt.slug] = create_lkt(kode,'');
				
			},
			_updateCookieRow: function(id,obj){
				let key = id;
				$.each(obj,function(i,j){
					let cookie_key = key + '_' + i;
					createCookie(cookie_key,j,1);
				});
			},
			_getCookieRow: function(id,key){
				let cookie_key = id+'_'+key;
				return readCookie(cookie_key);
				
			},
			init_lkt:function(n){
				let self=this;
				$.each(n,(i,j)=>{
					
					let kode = j.kode.toLowerCase();
					
					self[kode] = create_lkt(kode,j.nomor,j,true);

					let callAttempt = self._getCookieRow(self[kode].id,'callAttempt');
					callAttempt = parseInt(callAttempt)+0;
					if(!isNaN(callAttempt)){
						self[kode].callAttempt = callAttempt;
						if(callAttempt >= 1){
							self[kode].btnRegisterState= 1;
						}
						if(callAttempt >= 3){
							self[kode].btnSkipState = 1;
						}
					}
				});
			}
		},
		watch:{

			// a:function(n,o){

			// },
			// b:function(n,o){

			// },
			// c:function(n,o){

			// },
			lds:function(n,o){
				this.init_lkt(n);
			}
		}
	});
	let frmRegVm = new Vue({
		el:'#nav-form',
		data:{
			lkt:{},
			form:{
				nomor:'',
				id_antrian:'',
				nama:'',
				alamat:'',
				nama_poli:'',
				id_poli:'',
				dt:''
			}
		},
		
		methods:{
			onChangePoli:function(){
				let node = $('select[name=id_poli]');
				this.form.nama_poli = node.find('option:selected').text();

			},
			invalidForm:function(){
				let p_valid = 0;
				let p_invalid = [];
				$.each(this.form,(i,j)=>{
					if(j.length == ''){
						p_invalid.push(i);
					}else{
						p_valid += 1;
					}
				});
				return p_invalid.length > 0;
			},
			doRegisterForm:function(){
				let self = this;
				let max_valid = 6;
				let p_valid = 0;
				let p_invalid = [];
				$.each(this.form,(i,j)=>{
					if(j.length == ''){
						p_invalid.push(i);
					}else{
						p_valid += 1;
					}
				});
				if(p_invalid.length > 0){
					alert('Mohon Lengkapi Data Anda');
					setTimeout(()=>{
						$('input[name='+p_invalid[0]+']').focus();
					},500);
					return;
				}
				let url = base_url() + 'adm/loket_register';
				axios.post(url,this.form).then((r)=>{
					let result = r.data;
					if(result.status){
						admLoketVm._afterRegister(self.lkt);
						alert('Register Berhasil !');
						self.resetFormData();
					}
				});
				console.log(this.form);
			},
			resetFormData:function(){
				this.form = {
					nomor:'',
					id_antrian:'',
					nama:'',
					alamat:'',
					nama_poli:'',
					id_poli:'',
					dt:''
				};
			},
			setFormData: function(lkt){
				let self = this;
				this.lkt = lkt;
				this.form.nomor = lkt.nomor;
				this.form.id_antrian = lkt.id;
				this.form.dt = mysql_now();
				setTimeout(()=>{
					$('#nav-form input[name=nama]').focus();

				},1000);
			}
		}
	});
	function update_list_loket(ld,firstTime) {
		let url = '<?=base_url()?>adm/loket_list';
		axios.get(url).then((r)=>{
			//console.log(r);
			let content = '';
			let loket_data= $.extend({},admLoketVm.lds);
			// let lds = {};
			if(r.data.length == 0){
				content += '<tr><td colspan="5">Belum ada data antrian</td></tr>';

			}
			$.each(r.data,(id,item)=>{
				content += '<tr><td>'+(id+1)+'</td><td>'+item.nomor+'</td><td>'+item.waktu_mulai+'</td><td>'+item.slug.toUpperCase()+'</td><td>'+(item.status=='1'?'Menunggu':(item.status=='3'?'Lewat':'-'))+'</td></tr>'
					ld
				if(item.status == 1){
					if( typeof loket_data[item.slug] == 'undefined'){
						loket_data[item.slug] = create_loket(item,{});
						// console.log(loket_data[item.slug]);
					}
					else if(typeof loket_data[item.slug] != 'undefined'){
						if( loket_data[item.slug].status == -1){
							loket_data[item.slug] = create_loket(item,{});
							// console.log(loket_data[item.slug]);

						}
						
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