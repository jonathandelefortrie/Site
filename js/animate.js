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
		tab_x[1] = 7 * largeur / 100;
		tab_x[2] = 18 * largeur / 100;
		tab_x[3] = 30 * largeur / 100;
		tab_x[4] = 42 * largeur / 100;
		tab_x[5] = 54 * largeur / 100;
		tab_x[6] = 65 * largeur / 100;
		tab_x[7] = 77 * largeur / 100;
		tab_x[8] = 86 * largeur / 100;
		tab_x[9] = 95 * largeur / 100;
		tab_x[10] = 100 * largeur / 100;
	return tab_x;
}
function coord_y(){
	var tab_y = new Array();
		tab_y[0] = 400;
		tab_y[1] = 360;
		tab_y[2] = 320;
		tab_y[3] = 300;
		tab_y[4] = 245;
		tab_y[5] = 210;
		tab_y[6] = 155;
		tab_y[7] = 115;
		tab_y[8] = 60;
		tab_y[9] = 30;
		tab_y[10] = 0;
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
		case co_y[1] : title = "preparatory year of bachelor"; text = "Practical and applied arts, learning photoshop, illustrator, indesign and communication courses.";break;
		case co_y[2] : title = "preparatory year of bachelor"; text = "Practical and applied arts, learning html, javascript, flash, 3D and communication courses.";break;
		case co_y[3] : title = "internship"; text = "Within the web agency Neologis as a graphic designer for a period of one month.";break;
		case co_y[4] : title = "bachelor of computer graphics"; text = "Learning actionscript 2, 3D and communication courses.";break;
		case co_y[5] : title = "internship"; text = "Within the web agency Neologis as an integrator for a period of three months.";break;
		case co_y[6] : title = "preparatory year of master"; text = "Learning php, actionscript 3 and javascript/html5 approach to all technologies related to web development.";break;
		case co_y[7] : title = "internship"; text = "In the web agency LaNetscouade as front end developer specialized in data visualisation and UX advisor.";break;
		case co_y[8] : title = "master of computer science"; text = "Control of the MVC paradigm through Symfony 2 and learning mobile development with android-sdk and flex air.";break;
		case co_y[9] : title = "internship"; text = "In the web agency Makeable as front developer specialized in interactive content, I finished this experience like a back end developer focus on a customized dress platform in Laravel 3 during 6 month.";break;
		default : title = "career"; text = "Sometimes the graphics are better than words.";
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
	svg.polyline(lineGroup, [[co_x[0], co_y[0]],[co_x[1], co_y[1]],[co_x[2], co_y[2]], [co_x[3], co_y[3]], [co_x[4], co_y[4]], [co_x[5], co_y[5]], [co_x[6], co_y[6]], [co_x[7], co_y[7]], [co_x[8], co_y[8]], [co_x[9], co_y[9]], [co_x[10], co_y[10]]],{fill:'none', stroke:'#d2d2d1', strokeWidth:1});
	
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
