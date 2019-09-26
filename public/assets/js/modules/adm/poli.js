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
			init_list:function(){
				let self = this;
				let url = base_url() + 'adm/poli_list';

				axios.post(url,{}).then((r)=>{
					console.log(r)
					self.list = r.data;
					admPoliBox.init();
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
				
				this.callAttempt = 0;

			},
			executeBtnProc:function(meth){
				let method = '_executeBtn_'+ meth;
				return this[method]( );
			},
			_executeBtn_call:function(lkt){
			 
				let self = this;
				let textUri = 'Pangilan,_Kepada,__'+ this.nama.replace(/\W/,',')+',,    ,., '+this.alamat +',Harap, Menuju, ke ,'+this.nama_poli;
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
						this.callAttempt +=1;

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
});