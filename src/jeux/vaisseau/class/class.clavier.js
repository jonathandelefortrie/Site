function class_clavier_stock(){

	this.rightKey = "";
	this.leftKey = "";
	this.upKey = "";
	this.downKey = "";
	this.shootKey = "";
}
function class_clavier(){

	this.addev = function() {
		
		document.addEventListener('keydown', this.keyDDown, false);
		document.addEventListener('keyup', this.keyUUp, false);
	}
	// Détection des touches 
	this.keyDDown = function(e) {
	
		switch(e.keyCode) { 
			case 39: clavier_stock.rightKey = true; break;
			case 37: clavier_stock.leftKey = true;break;
			case 38: clavier_stock.upKey = true;break;
			case 40: clavier_stock.downKey = true;break;
			case 32: clavier_stock.shootKey = true;break;
		}
	}
	this.keyUUp = function (e) {
	
		switch(e.keyCode) {
			case 39: clavier_stock.rightKey = false;break;
			case 37: clavier_stock.leftKey = false;break;
			case 38: clavier_stock.upKey = false;break;
			case 40: clavier_stock.downKey = false;break;
			case 32: clavier_stock.shootKey = false;break;
		}
	}
}