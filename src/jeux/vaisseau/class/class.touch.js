function class_touch_stock(){

	this.rightTouch = "";
	this.leftTouch = "";
	this.upTouch = "";
	this.downTouch = "";
	this.shootTouch = "";
}
function class_touch(){

	this.addev = function() {
		
		document.addEventListener("touchstart", this.touchDDown, false);
	   	document.addEventListener("touchend", this.touchUUp, false);

	}
	// Detection des flèches sur IOS
	this.touchDDown = function(e) {
		
		switch(e.target.id) { 
			case "arrow-right": touch_stock.rightTouch = true; break;
			case "arrow-left": touch_stock.leftTouch = true;break;
			case "arrow-up": touch_stock.upTouch = true;break;
			case "arrow-down": touch_stock.downTouch = true;break;
			case "push-shot": touch_stock.shootTouch = true;break;
		}
	}
	this.touchUUp = function (e) {
	
		switch(e.target.id) {
			case "arrow-right": touch_stock.rightTouch = false; break;
			case "arrow-left": touch_stock.leftTouch = false;break;
			case "arrow-up": touch_stock.upTouch = false;break;
			case "arrow-down": touch_stock.downTouch = false;break;
			case "push-shot": touch_stock.shootTouch = false;break;
		}
	}
}