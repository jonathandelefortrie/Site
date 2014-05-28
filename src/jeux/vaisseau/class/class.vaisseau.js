function class_vaisseau() {
  
	this.vaisseau = navire;
 	this.life = vie;
  
	this.vaisseau_x = 300;
	this.vaisseau_y = 250; 
	this.vaisseau_w = 120; 
	this.vaisseau_h = 112;
  	
	this.vaisseau_speed = 8;		//vitesse origine
	this.vaisseau_speed_x = this.vaisseau_speed;		//vitesse  affecter x
	this.vaisseau_speed_y = this.vaisseau_speed;		//vitesse  affecter y
	this.vaisseau_speed_fire = 4;	//vitesse de feu
	
	this.acceleration_speed = 1.5;	//vitesse d'acceleration du vaisseau
	this.deceleration_speed = .5;	//vitesse de deceleration du vaisseau
	
	this.nb_vie = 10;
	
	this.create_vaisseau = function(largeur, hauteur)  
	{
		this.width = largeur;
		this.height = hauteur;
	}
	this.move_vaisseau = function(right, left, up, down)
	{
		//DEPLACEMENT//
		this.vaisseau_y += this.vaisseau_speed_y;
		this.vaisseau_x += this.vaisseau_speed_x;
		
		//LIMITES DE L'ECRAN//
		if (this.vaisseau_x <= 0) this.vaisseau_x = 0;
		if ((this.vaisseau_x + this.vaisseau_w) >= this.width) this.vaisseau_x = this.width - this.vaisseau_w;
		if (this.vaisseau_y <= 0) this.vaisseau_y = 0;
		if ((this.vaisseau_y + this.vaisseau_h) >= this.height) this.vaisseau_y = this.height - this.vaisseau_h;
		
		//DECELERATION//
		if(!right && this.vaisseau_speed_x > 0) this.vaisseau_speed_x -= this.deceleration_speed;
		else if(!left && this.vaisseau_speed_x < 0) this.vaisseau_speed_x += this.deceleration_speed;
		if(!up && this.vaisseau_speed_y < 0) this.vaisseau_speed_y += this.deceleration_speed;
		else if(!down && this.vaisseau_speed_y > 0) this.vaisseau_speed_y -= this.deceleration_speed;
		
		//ACCELERATION//
		if(right && this.vaisseau_speed_x < this.vaisseau_speed) this.vaisseau_speed_x += this.acceleration_speed;
		else if(left && this.vaisseau_speed_x >- this.vaisseau_speed) this.vaisseau_speed_x -= this.acceleration_speed;
		if(up && this.vaisseau_speed_y >- this.vaisseau_speed) this.vaisseau_speed_y -= this.acceleration_speed;	
		else if(down && this.vaisseau_speed_y < this.vaisseau_speed) this.vaisseau_speed_y += this.acceleration_speed;
	}
	this.destroy_vaisseau = function() {
   		for (key in this) { this[key]=null; }
	}
}