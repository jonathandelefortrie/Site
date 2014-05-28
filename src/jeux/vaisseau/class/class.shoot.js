function class_shoot() {  
	this.shoot_action == false;
	this.munition = 0;
	
	this.shoot_bullet = function(shot, largeur, hauteur, munition)
	{
		this.width = largeur;
		this.height = hauteur;
		
		if(shot) shoot(munition);
		else if(!shot && this.shoot_action == true) this.shoot_action = false;
		
		for (i=0; i<tab_bullet.length; i++) {
			tab_bullet[i].move_bullet();
			var cur_bullet_y = tab_bullet[i].bullet_y;
			if(cur_bullet_y > largeur){
				tab_bullet[i].destroy_bullet();
				tab_bullet.splice(i,1);
			}
		}
		function shoot(munition){
			// On enlève des munitions quand on tire jusqu'à en avoir 0 
			if(munition >= 1){
				munition--;			
			}
			// Bruitage des tires 
			document.getElementById('audio_balle').currentTime = 0;
			document.getElementById('audio_balle').volume = 0.5;
			document.getElementById('audio_balle').play();
			
			this.munition = munition;
			index_bullet++;
			if(this.shoot_action == false || index_bullet % vaisseau.vaisseau_speed_fire == 0) { 
				// Si munition est supérieur à 0, les doubles canons tirent
				if(munition >=1){
					
					bullet = new class_bullet();
					bullet.create_bullet_left(vaisseau.vaisseau_x, vaisseau.vaisseau_y);
					tab_bullet.push(bullet);
					
					bullet = new class_bullet();
					bullet.create_bullet_right(vaisseau.vaisseau_x, vaisseau.vaisseau_y);
					tab_bullet.push(bullet);
				}else {
					bullet = new class_bullet();
					bullet.create_bullet_center(vaisseau.vaisseau_x, vaisseau.vaisseau_y);
					tab_bullet.push(bullet);
				}
				if(index_bullet % vaisseau.vaisseau_speed_fire == 0){
					index_bullet = 0;
				}else if(this.shoot_action == false){ this.shoot_action = true; }
			}
		}
	}
}