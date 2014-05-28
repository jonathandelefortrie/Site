Storage.prototype.setObject = function(key, value) {
	this.setItem(key, JSON.stringify(value));
}
Storage.prototype.getObject = function(key) {
	return JSON.parse(this.getItem(key));
}
function add_best_score(Name,Score){
	$.ajax({
       type: "POST",
       url: "php/best_score.php",
       data: {name: Name, score: Score},
       success: function(res){$("#best_score").html(res);}
       });
} 
function add_local_score(Name,Time,Score) {
	$.ajax({
	 url: "php/add_score.php?jsoncallback=?",
	 data: {name: Name, score: Score, time: Time},
	 dataType: "json",
	 async: false,
	 success: function(array){
		 	
			if(!localStorage['score']) var dataArray = new Array;
			else var dataArray = localStorage.getObject('score');

			dataArray.push({'name':array.datas[0].name, 'score':array.datas[0].score, 'time':array.datas[0].time});
			localStorage.setObject('score',dataArray);
		 }
	});
	update_local_score();
}
function update_local_score(){
	
	var dataArray = localStorage.getObject("score");
	
	/*var first = 100000000, index_first = 0;	
	for(var u = 0; u < 10; u ++) {
			if(dataArray[u].score < first) {first = dataArray[u].score;index_first = u;}
	}
	dataArray.splice(index_first,1);*/
	
	var arrayTmp = new Array();
	var long_tab = dataArray.length;
	for(var u = 0; u < long_tab; u ++) {
			var bigger = 0, index_bigger = 0;
		for(var i = 0; i < dataArray.length; i ++) {
			
				if(dataArray[i].score > bigger) {bigger = dataArray[i].score;index_bigger = i;}
		}
		arrayTmp.push(dataArray[index_bigger]);
		dataArray.splice(index_bigger,1);
	}
	
	localStorage.setObject('score',arrayTmp);
	display_local_score();
}
function display_local_score(){
	
	if(!localStorage["score"]) return false;
	var dataArray = localStorage.getObject("score");
	
	var data = "";
	for(var u = 0; u < dataArray.length; u ++) {
		data += '<span class="line">';
		data += dataArray[u].score + ' ' + dataArray[u].name + ' ' + dataArray[u].time;
		data += '</span>';
	}
	$("#last_score").html(data);
}
function recup_score(){
	
	var name = $("#nom").val();
	
	Today = new Date;
	Jour = Today.getDate();
	Mois = (Today.getMonth())+1;
	Annee = Today.getFullYear();
	date = Jour + "/" + Mois + "/" + Annee;

	add_local_score(name,date,score);
	add_best_score(name, score);
	form_visible();
}
function form_visible(){
	if(score != 0){
	if ($(".formulaire").is(":hidden")) $(".formulaire").fadeIn("fast");
	else if ($(".formulaire").is(":visible")) $(".formulaire").fadeOut("fast");
	}
	if(score == 0 && visible == true && munition != 0){
	if ($(".formulaire").is(":hidden")) $(".formulaire").fadeIn("fast");
	else if ($(".formulaire").is(":visible")) $(".formulaire").fadeOut("fast");	
	}
	if(score == 0 && visible == false && munition == 0){
	if ($(".formulaire").is(":hidden")) $(".formulaire").fadeIn("fast");
	else if ($(".formulaire").is(":visible")) $(".formulaire").fadeOut("fast");	
	}
}