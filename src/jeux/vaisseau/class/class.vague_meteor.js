function class_vague_meteor(){
	
	this.nb_vague = 1;
	this.index_cadence = 0;
	this.cadence_limit = 10;
	this.nb_meteor = 0;
	this.bo_vague = true,
	this.nb_par_vague = 0,
	
	this.vague_meteor = function() 
	{
		if(this.bo_vague) {
			this.launch(this.nb_vague);
		}
		if(!this.bo_vague && tab_meteor.length == 0) {
			index_meteor ++;
			if(index_meteor > 100) {
				index_meteor = 0;
				this.bo_vague = true;
				this.nb_vague ++;
			}
		}
	}
	this.launch = function(nb_vague_recu) {
		this.nb_vague = nb_vague_recu;
		this.send();
	}	
	this.send = function() {
		this.index_cadence ++;
		if(this.index_cadence >= this.cadence_limit) {
			meteor = new class_meteor();
			meteor.create_meteor(largeur, hauteur);
			tab_meteor.push(meteor);
			this.nb_meteor ++;
			this.index_cadence = 0;
			this.nb_par_vague = 20 + Math.floor(Math.random()*300);
			// Chaque vague contient entre 20 et 50 meteors
			if(this.nb_meteor >= this.nb_par_vague) {
				this.bo_vague = false;
				this.nb_meteor = 0;
			}
		}	
	}
}