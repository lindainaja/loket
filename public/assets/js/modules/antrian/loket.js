$(document).ready(()=>{
	let loket_data = {};
	let appMonitorVm = new Vue({
		el:'#appMonitor',
		data:{
			// video_url:site_url('public/assets/videos/oceans.mp4'),
			a_cx:0,
			b_cx:0,
			c_cx:0,
			curr_no:'n/a',
			kode:''
		},
		mounted:function() {
			console.log('mounted')
			// console.log(this.video_url)
			// videojs('my-player').loadMedia({src:this.video_url});
			// videojs('my-player').play();
			$('video').get(0).play();

			this.init();
		},
		methods:{
			setData:function(data){
				this.a_cx = data.a_cx;
				this.b_cx = data.b_cx;
				this.c_cx = data.c_cx;
				this.curr_no = data.curr_no;

				this.kode = this.curr_no.toLowerCase()[0];

				let colours={
					'a':'rgb(63, 196, 269)',
					'b':'rgb(99, 226, 162)',
					'c':'rgb(265, 97, 86)'
				} ;

				$('.b-curr-no').css('background-color',colours[this.kode]);
			},
			init:function(){
				let url = base_url()+'antrian/loket_init';
				let self = this;
				axios.post(url,{}).then((r)=>{
					self.setData(r.data);
				})
			}
		}
	});

	//**************************************************
	let Ws = {
		conn: 0,
		instance:false,
		autoReconnectInterval : 5*1000,
		init:function() {
			Ws.conn = new ab.Session('ws://localhost:8080',
				()=>{
					Ws.conn.subscribe('onUpdateDal',(cat,item)=>{
						appMonitorVm.setData(item.data);
			 			console.log(cat)
			 			console.log(item.data)

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

	// $(document.body).on('mouseover',()=>{
	// 	$('video').get(0).muted=false;
	// });

	$(window).resize(()=>{
		setTimeout(()=>{
			let wh = $(window).height();
			let ah = $('.row.a').height();
			let bh = $('.row.b').height();
			let ch = $('.row.c').height();
			let h1cnh = $('h1.curr_no').height();


			let rh = wh - ah - ch;
			let mgtop = (rh - (h1cnh)-10)/2; 
			$('.p_curr_no').css('margin-top',mgtop+'px');
			$('video').css('height',(rh-1)+'px').css('width','auto');
			console.log(rh);
		},500);
	}).resize();
});


