function class_bullet() {  

	this.i_bullet = balle;
	this.bullet_x = 0;
	this.bullet_y = 0;
	this.bullet_w = 2;
	this.bullet_h = 15;
	this.bullet_vy = 10;
	
	this.statut_x = 0;
	// Function des différentes balles : gauche milieu droite
	this.create_bullet_left = function(vaisseau_x, vaisseau_y)  
	{  
		this.bullet_x = vaisseau_x + 5;
		this.bullet_y = vaisseau_y + 20;
	}
	this.create_bullet_right = function(vaisseau_x, vaisseau_y)  
	{  
		this.bullet_x = vaisseau_x + 114;
		this.bullet_y = vaisseau_y + 20;
	}
	this.create_bullet_center = function(vaisseau_x, vaisseau_y)  
	{  
		this.bullet_x = vaisseau_x + 59;
		this.bullet_y = vaisseau_y + 20;
	}
	this.move_bullet = function()
	{
		this.bullet_y -= this.bullet_vy;
		if(munition >=1)this.statut_x=1;
		else this.statut_x=0;
	}
	this.destroy_bullet = function() {
   		for (key in this) { this[key]=null; }
	}
}