function class_item()  
{  
	this.i_item = bonus;
	this.item_x = 0;
	this.item_y = 0;
	this.item_w = 30;
	this.item_h = 12;
	this.item_vy = 2;
	
	this.statut_y = 0;
	this.statut_max = 2;
	this.statut_cadence = 0;
	this.statut_cadence_max = 0;
	
	this.create_item = function()
	{
		this.item_x = 20+Math.round(Math.random()*(760));
	}
	this.move = function()  
	{  
		this.item_y += this.item_vy;
		this.touche_item();
		
		if(this.item_vy > 0) this.statut_cadence_max = 0;
		else this.statut_cadence_max = 1;
		
		if(this.statut_cadence >= this.statut_cadence_max) {
			if(this.statut_y < this.statut_max) this.statut_y ++;
			else this.statut_y = 0;
			this.statut_cadence = 0;
		}
		else this.statut_cadence ++;
	}
	this.touche_item = function()
	{
		// Item ramassé par le vaisseau
		for(m=0; m<tab_items.length; m++) {
			if((tab_items[m].item_x > vaisseau.vaisseau_x && tab_items[m].item_x < vaisseau.vaisseau_x+90) && (tab_items[m].item_y > vaisseau.vaisseau_y-15 && tab_items[m].item_y < vaisseau.vaisseau_y+50)){
				
				tab_items[m].destroy();
				tab_items.splice(m,1);
				// on augmente le nombre de munition
				munition = munition + 200;
				// le score augmente de 300 lorsque l'on ramasse un item
				if(vaisseau.nb_vie > 0){
					score = score + 300;
				}
			}
		}
	}
	this.destroy = function() 
	{
   		for (key in this) { this[key]=null; }
	}
}