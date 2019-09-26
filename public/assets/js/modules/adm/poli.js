$(document).ready(()=>{
	//
	let admPoliTable = new Vue({
		'el':'#admPoliTable',
		data:{
			list:[]
		},
		mounted: function(){
			this.init_list();
		},
		methods:{
			init_list:function(skip){
				let self = this;
				let url = base_url() + 'adm/poli_list';

				axios.post(url,{}).then((r)=>{
					console.log(r)
					self.list = r.data;
					if(typeof skip == 'undefined'){
						admPoliBox.init();
					}
					
				});
			}
		}
	});
	let admPoliBox = new Vue({
		'el':'#admPoliBox',
		data:{
			id_poli:'',
			nama_poli:'',
			nama:'',
			alamat:'',
			callAttempt:0,
			btnSkipState:0,
			btnCallState:1,
			btnApotikState:0,
			status:-1,
			jenis:'',
			row:{},
			TTS_STATE:1,
			lastPlayAttempt :0
		},
		mounted: function(){
			this.init();
		},
		methods:{
			init:function(){
				this.nextQueue();
			},
			nextQueue: function(){
				for(let i = 0 ; i < admPoliTable.list.length ; i++){
					row = admPoliTable.list[i];
					if(row.status == 1){
						this.row = row;
						this.setData(row)
						break;
					}
				}
			},
			setData:function(row){
				this.id_poli = row.poli_id;
				this.nama_poli = row.nama_poli;
				this.nama = row.nama;
				this.alamat = row.alamat;
				this.jenis = row.jenis;
				this.status = row.status;
				this.id_ap = row.id;
				this.btnSkipState = 0;
				this.btnApotikState = 0;
				
				this.callAttempt = 0;
				// GET CALL ATTEMP FROM COOKIE
				this.callAttempt = this.getRawCookie('callAttempt',this.id_ap,0);
			},
			executeBtnProc:function(meth){
				let method = '_executeBtn_'+ meth;
				return this[method]( );
			},
			_executeBtn_call:function(lkt){
			 
				let self = this;
				let nama_poli = this.nama_poli;

				if(nama_poli.match(/\BP\/KIA/)){
					nama_poli = 'Poli,B,P,,,K,I,A';
				}
				let textUri = 'Pangilan,_Kepada,__'+ this.nama.replace(/\W/,',')+',,    ,., '+this.alamat +',Mohon,Segera, Menuju, ke ,'+nama_poli;
				let url = base_url() + 'tts/speak/' + btoa(textUri)+'/audio.mp3?q='+(new Date()).getTime();

				videojs('aplayer').loadMedia({src:url});
				videojs('aplayer').play();

				// this.callAttempt += 1;

				// let dpl_url = base_url() + 'adm/loket_update_dal';

				// axios.post(dpl_url,lkt).then((r)=>{
				// 	console.log(r.data);
				// });
			},
			
			_executeBtn_skip:function(lkt){
				//ERASE COOKIE
				let self = this;
				let skip_url = base_url() + 'adm/poli_skip/'+this.id_ap;

				axios.post(skip_url,{id:this.id_ap}).then((r)=>{
					console.log(r.data);

					self.status = 2;
					
					self.clearRawCookie('callAttempt',this.id_ap);
					admPoliTable.init_list();

				})
			},
			_executeBtn_apotik:function(lkt){

			},
			_executeBtn_laborat:function(lkt){

			},
			onUpdatePlayerState:function(state){
				let self = this;
				// let kode = this.currentCode;
				// console.log(kode);

				this.btnCallState = 0;

				switch(state){
					case 'playing':
				    	// console.log('self['+kode+'].btnCallState='+self[kode].btnCallState);
					break;
					case 'ended':
						this.btnCallState = 1;
						this.TTS_STATE = 0;
						this.lastPlayAttempt = 0;

						//
						this.callAttempt = parseInt(this.callAttempt)+1;
						this.updateRawCookie('callAttempt',this.id_ap,this.callAttempt);
						if(this.callAttempt >= 3){
							this.btnSkipState = 1;
						}
						
						// self._updateCookieRow(self[kode].id,{
						// 	callAttempt:self[kode].callAttempt,
						// });

						// console.log(JSON.stringify(self[kode]));
					break;
					case 'error':
						this.btnCallState = 1;
						this.TTS_STATE = 0;
						if(this.lastPlayAttempt<3){
							setTimeout(()=>{
								self._executeBtn_call();
								self.lastPlayAttempt += 1;
							},500);
							
						}else{
							alert('Tts Error Detected !!!');
						}
					break;
				}
			},
			clearRawCookie:function(prop,id){
				let cookie_key = id + '_ap_' + prop;
				eraseCookie(cookie_key);
			},
			updateRawCookie: function(prop,id,value){
				let cookie_key = id + '_ap_' + prop;
				eraseCookie(cookie_key);
				createCookie(cookie_key,value,1);
			 
			},
			getRawCookie: function(prop,id,d){
				let cookie_key = id+'_ap_'+prop;
				let r = readCookie(cookie_key);
			 
				return !r?d:r;
			},
		}
	});

	//

	let player  = videojs('aplayer');

	player.on('playing',()=>{
    	admPoliBox.onUpdatePlayerState('playing');
    });
    player.on("ended",function(){
    	admPoliBox.onUpdatePlayerState('ended');
    });
    player.on("error",function(){
    	admPoliBox.onUpdatePlayerState('error');
	});
	
	//**************************************************

	 

	let Ws = {
		conn: 0,
		instance:false,
		autoReconnectInterval : 5*1000,
		init:function() {
			Ws.conn = new ab.Session('ws://localhost:8080',
				()=>{
					Ws.conn.subscribe('onCreateAp',(cat,item)=>{
						 
						console.log('Ada pendaftaran loket baru : '+item.data.nomor);
						// console.log(item.data);
			 			admPoliTable.init_list(true);

					});
				},
				()=>{
					console.warn('koneksi WecbSocket ditutup');
					Ws.reconnect();
				},
				{'skipSubprotocolCheck': true}
			); 
		},
		reconnect : function( ){
			console.log('Ws: retry in '+Ws.autoReconnectInterval+'ms' );
			var self = Ws;
			setTimeout(function(){
				console.log("Ws: reconnecting...");
				self.init();
			},Ws.autoReconnectInterval);
		}

	}
	
	Ws.init();
	//*************************************************

});