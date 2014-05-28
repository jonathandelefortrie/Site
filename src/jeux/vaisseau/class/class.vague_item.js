function class_vague_item()  
{  
	this.nb_item = 0;
	this.nb_vague = 0;
	this.bo_vague = true,
	this.index_cadence = 0;
	this.cadence_limit = 0;
	
	this.ordre_item = Array();
	
	this.vague_item = function() {
		if(this.bo_vague) {
			this.launch(this.nb_vague);
		}
		if(!this.bo_vague) {
			index_item ++;
			if(index_item > 300) {
				index_item = 0;
				this.bo_vague = true;
				this.nb_vague ++;
			}
		}
	}
	this.launch = function() {
		this.cadence_limit = 80;
		this.vague();
	}		
	this.vague = function() {
		this.index_cadence ++;
		if(this.index_cadence >= this.cadence_limit) {
			items = new class_item();
			items.create_item();
			tab_items.push(items);
			
			this.nb_item ++;
			this.index_cadence = 0;
			
			if(this.nb_item >= this.ordre_item.length) {
				this.bo_vague = false;
				this.nb_item = 0;
			}
		}	
	}	
}