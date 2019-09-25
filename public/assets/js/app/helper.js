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
	// console.log(textSpeech);
	return textSpeech;
}
