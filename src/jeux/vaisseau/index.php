<?php
	include("libs/incs.php");
	include_once("php/preloader.php");
	include_once('inc/connect.inc.php');
	include_once('prive/param_bd.php');
	$images_path = "img/";
	$sound_path = "audio/";
	$function_finish = "init();";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>War of Meteor</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" charset="utf-8" src="js/jquery.js"></script>
</head>
<body>
<div class="content">
  	<div class="header">
    	<div class="content-header">
        <div class="formulaire">
            <form id="form_score">
                <input id="nom" name="nom" type="text" placeholder="Votre nom ici" size="50" />
                <input id="button" name="button" value="envoyer" type="button" onclick="javascript:recup_score();" />
            </form>
        </div>
        <div class="replay" onclick="score=0; munition=0; vaisseau.nb_vie=10; visible=true; game_over=false; javascript:form_visible();"><div class="title-replay">Rejouer</div></div>
        </div>
    </div>
    <div class="middle">
    	<div class="content-jeux">
            <div class="top"><div class="title-top">War of Meteor</div></div>
            <div class="game">
                <canvas id="canvas" width="800" height="450">
                Your browser does not support the canvas element.
                </canvas>
            </div>
            <div class="score">
                <div class="title"><span class="title-text">Meilleur Score</span></div>
                <div id="best_score" class="text_score">
                <?php 
                    
                    $connexion = connexion_bd(SERVEUR,LOGIN,PASSWORD,BASE);
        
                    $requete = "SELECT * FROM jeux ORDER BY score DESC LIMIT 10";
                    $resultat = mysql_query($requete, $connexion);
                    
                    $best_score = "";
                    
                    while ($score = mysql_fetch_assoc($resultat))
                    {
                        $best_score.= "<span class=\"line\">";
                        $best_score.= $score['score'] . " " . $score['pseudo'];
                        $best_score.= "</span>";
                    }
                    echo $best_score;
                    
                ?>
                </div>
            </div>
            <div class="score">
                <div class="title"><span class="title-text">Dernier Score</span></div>
                <div id="last_score" class="text_score"></div>
            </div>
        </div>
        <audio id="audio_ambiance" controls preload style="display:none;">
            <source src="audio/ambiance.ogg">
            <source src="audio/ambiance.mp3">
            <source src="audio/ambiance.wav">
		</audio>
        <audio id="audio_balle" controls preload style="display:none;">
            <source src="audio/tir.ogg">
            <source src="audio/tir.mp3">
            <source src="audio/tir.wav">
		</audio>
        <audio id="audio_explosion" controls preload style="display:none;">
            <source src="audio/explosion.ogg">
            <source src="audio/explosion.mp3">
            <source src="audio/explosion.wav">
		</audio>
        
        <div style="display:none;">
            <canvas id="buffer" width="800" height="450">
            Your browser does not support the canvas element.
            </canvas>
        </div>
        <div id="content-button" style="width:800px; height:152px; display:none; float:left; visibility:hidden;">
            <div class="arrow">
           		<div id="arrow-up" class="arrow-up"><img src="img/bt_up_do.png" border="no" /></div>
                <div id="arrow-left" class="arrow-left"><img src="img/bt_ri_le.png" border="no" /></div>
                <div id="arrow-right" class="arrow-right"><img src="img/bt_ri_le.png" border="no" /></div>
                <div id="arrow-down" class="arrow-down"><img src="img/bt_up_do.png" border="no" /></div>
            </div>
            <div class="push">
                <div id="push-shot" class="push-shot"><img src="img/push_shot.png" border="no" /></div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript" charset="utf-8" src="class/class.bullet.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.shoot.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.decor.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.clavier.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.touch.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.vaisseau.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.item.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.meteor.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.vague_meteor.js"></script>
<script type="text/javascript" charset="utf-8" src="class/class.vague_item.js"></script>
<script type="text/javascript" charset="utf-8">
<?php 
	// preload des images et des sons
	preloader_canvas($sound_path,$images_path,$function_finish);
?>
// Déclaration des images
var meteorite = new Image();
meteorite.src = "img/meteor.png";
var balle = new Image();
balle.src = "img/balle.png";
var bonus = new Image();
bonus.src = "img/bonus.png";
var navire = new Image();
navire.src = "img/navire.png";
var vie = new Image();
vie.src = "img/vie.png";

var ctx,
	canvas,
	buffer,
	ctx_buffer,
	largeur = 800,
	hauteur = 450,
	vitesse_move = 40,
	vitesse_draw = 10,
	munition = 0,
	score = 0,
	
	game_over = false;
	visible = true;
	
	right=false,
	left=false,
	up=false,
	down=false,
	shot=false,
	
	tab_meteor = Array(),
	index_meteor = 0,
	
	tab_items = new Array();
	index_item = 0,
	
	tab_bullet = Array(),
	index_bullet = 0,
	
	isIOS = navigator.userAgent.match(/iPad/i) != null || navigator.userAgent.match(/iPhone/i) != null,
	isAndroid = navigator.userAgent.match(/Android/i) != null,
	hasTouchEvent = isIOS || isAndroid;
// on initialise le jeu
function init() {
	
	buffer = document.getElementById('buffer');
	canvas = document.getElementById('canvas');

	ctx_buffer = buffer.getContext('2d');
	ctx = canvas.getContext('2d');
	
	if(hasTouchEvent) {
		document.getElementById('content-button').style.visibility="visible";
		document.getElementById('content-button').style.display="block";
		touch_stock = new class_touch_stock();
		touch = new class_touch();
		touch.addev();
		
	}else {
		clavier_stock = new class_clavier_stock();
		clavier = new class_clavier();
		clavier.addev();
	}
	
	vaisseau = new class_vaisseau();
	vaisseau.create_vaisseau(largeur, hauteur);
	
	decor = new class_decor();
	decor.create_decor(largeur, hauteur);
	
	shoot = new class_shoot();
	
	meteor_vague = new class_vague_meteor();
	
	item_vague = new class_vague_item();
	
	setInterval(move, vitesse_move);
	setInterval(draw, vitesse_draw);
}

// boucle de refresh 
function move() {
	
	if(hasTouchEvent) {
		right = touch_stock.rightTouch;
		left = touch_stock.leftTouch;
		up = touch_stock.upTouch;
		down = touch_stock.downTouch;
		shot = touch_stock.shootTouch;
	}else {
		right = clavier_stock.rightKey;
		left = clavier_stock.leftKey;
		up = clavier_stock.upKey;
		down = clavier_stock.downKey;
		shot = clavier_stock.shootKey;
	}

	for (i=0; i<tab_items.length; i++) {	
 		if(tab_items[i].item_y > 450){
 			tab_items[i].destroy();
 			tab_items.splice(i,1);
 		}
 		else tab_items[i].move();
	}
	
	for (i=0; i<tab_meteor.length; i++) {
		if(tab_meteor[i].meteor_y > 450){
			tab_meteor[i].destroy_meteor();
			tab_meteor.splice(i,1);
		}
		else tab_meteor[i].move_meteor();
	}
	
	document.getElementById('audio_ambiance').volume = 0.1;
	document.getElementById('audio_ambiance').play();
	
	vaisseau.move_vaisseau(right, left, up, down);
	decor.move_decor(right, left, up, down);
	shoot.shoot_bullet(shot, largeur, hauteur, munition);

	meteor_vague.vague_meteor();
	item_vague.vague_item();
	
	// Tableau de comparaison entre balle / vaisseau / meteor 
	for(l=0; l<tab_meteor.length; l++) {
		// Collision entre le vaisseau et une météorite
		if((vaisseau.vaisseau_x+vaisseau.vaisseau_w) >= tab_meteor[l].meteor_x && vaisseau.vaisseau_x <= (tab_meteor[l].meteor_x+tab_meteor[l].meteor_w) && (vaisseau.vaisseau_y+vaisseau.vaisseau_h) >= tab_meteor[l].meteor_y && vaisseau.vaisseau_y <= (tab_meteor[l].meteor_y+tab_meteor[l].meteor_h) && tab_meteor[l].live == true) {
			
			if(tab_meteor[l].live == true) vaisseau.nb_vie --;
			
			document.getElementById('audio_explosion').currentTime = 0;
			document.getElementById('audio_explosion').volume = .7;
			document.getElementById('audio_explosion').play();
			
			tab_meteor[l].live = false;
			tab_meteor[l].statut_x = 0;
			if(tab_meteor[l].statut_x == 24){
				tab_meteor[l].destroy_meteor();
				tab_meteor.splice(l,1);
			}
			
		}
		for (m=0; m<tab_bullet.length; m++) {
			// Collision entre une balle et une météorite
			if((tab_bullet[m].bullet_x+tab_bullet[m].bullet_w) >= tab_meteor[l].meteor_x && tab_bullet[m].bullet_x <= (tab_meteor[l].meteor_x+tab_meteor[l].meteor_w) && (tab_bullet[m].bullet_y+tab_bullet[m].bullet_h) >= tab_meteor[l].meteor_y && tab_bullet[m].bullet_y <= (tab_meteor[l].meteor_y+tab_meteor[l].meteor_h) &&tab_meteor[l].live == true) {
				if(vaisseau.nb_vie > 0 && tab_meteor[l].live == true){
					score = score + 100;
				}
				tab_meteor[l].live = false;
				tab_meteor[l].statut_x = 0;
				if(tab_meteor[l].statut_x == 24){
					tab_meteor[l].destroy_meteor();
					tab_meteor.splice(l,1);
				}
				tab_bullet[m].destroy_bullet();
				tab_bullet.splice(m,1);
				
				document.getElementById('audio_explosion').currentTime = 0;
				document.getElementById('audio_explosion').volume = .7;
				document.getElementById('audio_explosion').play();
			}	
		}
	}
	if(vaisseau.nb_vie <= 0){
		game_over = true;
		if(visible && score != 0) {
			form_visible();
			visible = false;
		}
	}
}
// Clean du canvas
function clear() {
	
	ctx.clearRect(0, 0, largeur, hauteur);
	ctx_buffer.clearRect(0, 0, largeur, hauteur);
}

// On dessine tous dans le canvas
function draw() {
	
	clear();
	ctx_buffer.drawImage(decor.background, 0, 0, largeur, hauteur, 0, 0, largeur, hauteur);
	ctx_buffer.drawImage(decor.moyen_bg, decor.moyen_x, decor.moyen_y, largeur, hauteur, decor.moyen_dx, decor.moyen_dy, largeur, hauteur);
	ctx_buffer.drawImage(decor.grand_bg, decor.grand_x, decor.grand_y, largeur, hauteur, decor.grand_dx, decor.grand_dy, largeur, hauteur);
	for (i=0; i<tab_items.length; i++) {
		ctx_buffer.drawImage(tab_items[i].i_item, 0, 0, tab_items[i].item_w, tab_items[i].item_h, tab_items[i].item_x, tab_items[i].item_y, tab_items[i].item_w, tab_items[i].item_h);
	}
	for (i=0; i<tab_bullet.length; i++) {
		ctx_buffer.drawImage(tab_bullet[i].i_bullet, tab_bullet[i].statut_x*tab_bullet[i].bullet_w, 0, tab_bullet[i].bullet_w, tab_bullet[i].bullet_h, tab_bullet[i].bullet_x, tab_bullet[i].bullet_y, tab_bullet[i].bullet_w, tab_bullet[i].bullet_h);
	}
	for (i=0; i<tab_meteor.length; i++) {
		ctx_buffer.drawImage(tab_meteor[i].i_meteor, tab_meteor[i].statut_x*tab_meteor[i].meteor_w, tab_meteor[i].statut_y*tab_meteor[i].meteor_h, tab_meteor[i].meteor_w, tab_meteor[i].meteor_h, tab_meteor[i].meteor_x, tab_meteor[i].meteor_y, tab_meteor[i].meteor_w, tab_meteor[i].meteor_h);
	}
	ctx_buffer.drawImage(vaisseau.vaisseau, 0, 0, vaisseau.vaisseau_w, vaisseau.vaisseau_h, vaisseau.vaisseau_x, vaisseau.vaisseau_y, vaisseau.vaisseau_w, vaisseau.vaisseau_h);
	// bandeau du bas
	ctx_buffer.globalAlpha = 0.5;
	ctx_buffer.fillStyle = "rgb(50,50,50)";
	ctx_buffer.fillRect(0,410,800,40);
	ctx_buffer.globalAlpha = 1;
	// Texte sur le bandeau
	ctx_buffer.font = "16pt Calibri,Geneva,Arial";
    ctx_buffer.fillStyle = "rgb(255,255,255)";
	ctx_buffer.fillText("Vie :   ", 10, 435);
    ctx_buffer.fillText("Score :   "+score, 650, 435);
    ctx_buffer.fillText("Munition :  "+munition, 350, 435);
    
    // affichage vie
    for (i=0; i<vaisseau.nb_vie; i++) {
		ctx_buffer.drawImage(vaisseau.life, 0, 0, 5, 28, 60+i*10, 415, 5,28);
	}
	// Bandeau Game over
	if(game_over){
		
		// bandeau Game over
		ctx_buffer.globalAlpha = 0.5;
		ctx_buffer.fillStyle = "rgb(255,30,30)";
		ctx_buffer.fillRect(0,150,800,120);
		ctx_buffer.globalAlpha = 1;
		// texte game over
		ctx_buffer.font = "35pt Calibri,Geneva,Arial";
		ctx_buffer.fillStyle = "rgb(255,255,255)";
		ctx_buffer.fillText("GAME OVER", 280, 210);
		ctx_buffer.font = "16pt Calibri,Geneva,Arial";
		ctx_buffer.fillStyle = "rgb(255,255,255)";
		ctx_buffer.fillText("Score :   "+score, 340, 240);
	}
	ctx.drawImage(buffer, 0, 0);
}
preload_site();
</script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function (){
	display_local_score();
});
</script>
<script type="text/javascript" charset="utf-8" src="js/jquery-script.js"></script>
</body>
</html>
