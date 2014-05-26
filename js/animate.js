/*
 * Jonathan Delefortrie animate svg in html DOM
 */

function Init(){

	if($('#content-load').children(':first-child').attr('id') != "content-parcours") return false;
	
	$('#svg').svg();
	var svg = $('#svg').svg('get');
	
	$('#svg').mousemove(function(event) {
		move(svg, event);
	});
	drawLine(svg);
}

function coord_x(){
	var tab_x = new Array();
		tab_x[0] = 0 * largeur / 100;
		tab_x[1] = 11 * largeur / 100;
		tab_x[2] = 22 * largeur / 100;
		tab_x[3] = 33 * largeur / 100;
		tab_x[4] = 44 * largeur / 100;
		tab_x[5] = 55 * largeur / 100;
		tab_x[6] = 66 * largeur / 100;
		tab_x[7] = 77 * largeur / 100;
		tab_x[8] = 88 * largeur / 100;
		tab_x[9] = 100 * largeur / 100;
	return tab_x;
}
function coord_y(){
	var tab_y = new Array();
		tab_y[0] = 400;
		tab_y[1] = 360;
		tab_y[2] = 310;
		tab_y[3] = 300;
		tab_y[4] = 245;
		tab_y[5] = 210;
		tab_y[6] = 155;
		tab_y[7] = 115;
		tab_y[8] = 40;
		tab_y[9] = 0;
	return tab_y;
}

function move(svg, event){

	getText(null);

	var startX = 0;
	var startY = 0;

	var co_x = new_x.slice();
	var co_y = new_y.slice();

	var destX = event.pageX - $('#svg').offset().left;
	var destY = event.pageY - $('#svg').offset().top;
	
	for(var i=1; i<total; i++){
		var posX = co_x[i];
		var posY = co_y[i];
		var returnPoint = getPoint(destX, destY, posX, posY);
		
		startX = co_x[i];
		startY = co_y[i];
		
		if(returnPoint < 30){
			id = 2;
			drawCycle(svg, id, startX, startY);
			getText(startY);
		}
		else if(returnPoint < 50){
			id = 1;
			drawCycle(svg, id, startX, startY);
			getText(startY);
		}
		else if(returnPoint > 50){
			id = 2;
			clearCycle(id, startX, startY);			
		}
	}
}

function getText(startY){

	var co_y = new_y.slice();

	switch(startY) {
		case co_y[1] : title = "ann&eacute;e pr&eacute;paratoire licence"; text = "Pratique des arts appliqués et plastiques, apprentissage de photoshop, illustrator, indesign ainsi que des cours de communication.";break;
		case co_y[2] : title = "ann&eacute;e pr&eacute;paratoire licence"; text = "Pratique des arts appliqués et plastiques, apprentissage du html, javascript, flash, 3D ainsi que des cours de communication.";break;
		case co_y[3] : title = "stage en entreprise"; text = "Au sein de l'agence web neologis en tant que graphiste d'une durée de un mois.";break;
		case co_y[4] : title = "licence en infographie"; text = "Apprentissage de l'action script 2 et de la 3D ainsi que des cours de communication.";break;
		case co_y[5] : title = "stage en entreprise"; text = "Au sein de l'agence web neologis en tant qu'int&eacute;grateur d'une durée de trois mois.";break;
		case co_y[6] : title = "ann&eacute;e pr&eacute;paratoire master"; text = "Apprentissage du php, action script 3, javascript/html5 et approche de toutes les technologies liées aux développement web.";break;
		case co_y[7] : title = "stage en entreprise"; text = "Au sein de l'agence web La Netscouade en tant que développeur front end.";break;
		case co_y[8] : title = "master en développement web"; text = "Maîtrise du mvc, symfony, flex et apprentissage du développement mobile android-sdk, flex air.";break;
		default : title = "parcours"; text = "Parfois les graphiques valent mieux que les mots.";
	}
  	$('#img-title').html(title);
 	$('#img-text').html(text);
}

function getPoint(destX, destY, posX, posY){
	var getReturn = Math.sqrt(((destX - posX) * (destX - posX)) + ((destY - posY) * (destY - posY)));
	return getReturn;
}

function clearLine(){

	$('#svg').svg();
	var svg = $('#svg').svg('get');
	
	var g = svg.getElementById('lineGroup');
	if(g != null) svg.remove(g);
	
	for(var i=1; i<total; i++){
		var c = svg.getElementById('cycleGroup_o'+i);
		if(c != null) svg.remove(c);
	}
	for(var i=1; i<total; i++){
		var c = svg.getElementById('cycleGroup_e'+i);
		if(c != null) svg.remove(c);
	}
}

function clearCycle(id, startX, startY){

	$('#svg').svg();
	var svg = $('#svg').svg('get');
	
	for(var i=0; i<id; i++){
		var d = svg.getElementById('cycleGroup_'+i+'_'+startX+'_'+startY);
		if(d != null) svg.remove(d);
	}
}

function drawCycle(svg, id, startX, startY){
	clearCycle(id, startX, startY);
	
	var circo = new Array(15,19);
	
	for(var i=0; i<id; i++){
		var cycleGroup = svg.group(null, 'cycleGroup_'+i+'_'+startX+'_'+startY);
		svg.circle(cycleGroup, startX, startY, circo[i], {fill:'none', stroke:'#5c5b5e', strokeWidth: 2});
	}
}

function drawLine(svg){
	clearLine();

	var co_x = new_x.slice();
	var co_y = new_y.slice();
	
	var lineGroup = svg.group(null, 'lineGroup');
	svg.polyline(lineGroup, [[co_x[0], co_y[0]],[co_x[1], co_y[1]],[co_x[2], co_y[2]], [co_x[3], co_y[3]], [co_x[4], co_y[4]], [co_x[5], co_y[5]], [co_x[6], co_y[6]], [co_x[7], co_y[7]], [co_x[8], co_y[8]], [co_x[9], co_y[9]]],{fill:'none', stroke:'#d2d2d1', strokeWidth:1});
	
	for(var i=1; i<total; i++){
		var cycleGroup = svg.group(null, 'cycleGroup_o'+i);
		svg.circle(cycleGroup, co_x[i], co_y[i], 4.5, {fill:'#32859e'});
	}
	for(var i=1; i<total; i++){
		var cycleGroup = svg.group(null, 'cycleGroup_e'+i);
		svg.circle(cycleGroup, co_x[i], co_y[i], 11, {fill:'none', stroke:'#5c5b5e', strokeWidth: 2});
	}
}

function doAnimate(){

	if($('#content-load').children(':first-child').attr('id') != "content-parcours") return false;

	largeur = $('#svg').width();
	new_x = coord_x();
	new_y = coord_y();

	getText(null);

	if(largeur > 0) Init();
}
