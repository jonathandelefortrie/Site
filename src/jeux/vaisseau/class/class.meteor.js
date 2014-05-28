function class_meteor(){ 
 
 	this.i_meteor = meteorite;
	
	this.meteor_x = 0;
	this.meteor_y = -64;
	this.meteor_w = 64;
	this.meteor_h = 64;
	
	this.meteor_vx = 0;
	this.meteor_vy = 10;
	
	this.statut_x = 0;
	this.statut_y = 0;
	this.statut_max = 0;
	this.statut_cadence = 0;
	this.statut_cadence_max = 0;
	
	this.create_meteor = function(largeur, hauteur)  
	{
		this.meteor_x = Math.floor(Math.random()*largeur);
		this.live = true;
	}
	this.move_meteor = function()  
	{  
		this.meteor_y += this.meteor_vy;
		
		if(this.live)this.statut_max = 19;
		else
		{
			this.statut_y = 1;
			this.statut_max = 25;
		}
		
		if(this.meteor_vy > 0) this.statut_cadence_max = 0;
		else this.statut_cadence_max = 1;
		
		if(this.statut_cadence >= this.statut_cadence_max) {
			if(this.statut_x < this.statut_max) this.statut_x ++;
			else this.statut_x = 0;
			this.statut_cadence = 0;
		}
		else this.statut_cadence ++;
	}

	this.destroy_meteor = function() 
	{
   		for (key in this) { this[key]=null; }
	}
}