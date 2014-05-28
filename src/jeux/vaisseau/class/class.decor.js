function class_decor(){

	this.background = new Image();
	this.vitesse_def = .1;
	this.scroller_x = 0;
	this.scroller_y = 0;
	this.moyen_bg = new Image();
	this.moyen_x = 90;
	this.moyen_y = 0;
	this.moyen_dx = 0;
	this.moyen_dy = 0;
	this.grand_bg = new Image();
	this.grand_x = 200;
	this.grand_y = 100;
	this.grand_dx = 0;
	this.grand_dy = 0;
	this.background.src = "img/bg_0.png";
	this.moyen_bg.src = "img/bg_1.png";
	this.grand_bg.src = "img/bg_2.png";

	this.create_decor = function(largeur, hauteur) {
		this.width = largeur;
		this.height = hauteur;
	}
	this.move_decor = function(right, left, up, down) {
		
		//this.scroller_x = this.moyen_dx - this.moyen_x;
		//this.scroller_y = this.moyen_dy - this.moyen_y;
		
		//MOUVEMENTS DECORS//
		//if (this.moyen_y > 0){ this.moyen_y -= this.vitesse_def;}
		//else {this.moyen_y = 100;}
		
		//LIMITES DE L'ECRAN//
	  if (this.moyen_x < 0) this.moyen_x = 0;
	  else if (this.moyen_x > 180) this.moyen_x = 180;
	  if (this.grand_x < 0) this.grand_x = 0;
	  else if (this.grand_x > 400) this.grand_x = 400;
		
		//ACCELERATION DECORS//
	  if(up){
	   if (this.grand_y > 0) this.grand_y -= .5;
	  }
	  else if(down){
	   if (this.grand_y < 100) this.grand_y += .5;
	  }
	  if(right){
	   if (this.moyen_x < 180) this.moyen_x += .1;
	   if (this.grand_x < 400) this.grand_x += .8;
	  }
	  else if(left){
	   if (this.moyen_x > 0) this.moyen_x -= .1;
	   if (this.grand_x > 0) this.grand_x -= .8;
	  }
	}
}