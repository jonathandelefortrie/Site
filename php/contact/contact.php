<?php
if(empty($_POST)){
	
	$content  = '<span id="content-contact" class="content-contact">';
	$content .=	'<form id="form-mail" method="post" action="javascript:upLoad(\'php/contact/contact.php\', \'content-load\')">';  
	$content .=	'<div class="content-input">';
	$content .= '<label for="familyname">LASTNAME</label>';
	$content .=	'<input id="familyname" name="familyname" size="50" type="text" class="correct" />';
	$content .=	'</div>';
	$content .=	'<div class="content-input">';
	$content .= '<label for="firstname">FIRSTNAME</label>';
	$content .=	'<input id="firstname" name="firstname" size="50" type="text" class="correct" />';
	$content .=	'</div>';
	$content .=	'<div class="content-input">';
	$content .= '<label for="email">EMAIL</label>';
	$content .=	'<input id="email" name="email" size="50" type="text" class="correct" />';
	$content .=	'</div>';
	$content .=	'<div class="content-input">';
	$content .= '<label for="subject">OBJECT</label>';
	$content .=	'<input id="subject" name="subject" size="50" type="text" class="correct" />';
	$content .=	'</div>';
	$content .=	'<div class="content-input">';
	$content .=	'<textarea id="message" name="message" cols="50" rows="10" class="text-correct" placeholder="WRITE YOUR MESSAGE HERE ..." ></textarea>';
	$content .=	'</div>';
	$content .=	'<div class="content-input">';
	$content .=	'<div class="img-line-mail"></div>';
	$content .=	'<input id="send" name="send" alt="envoyer" value="send ..." type="submit" />';
	$content .=	'</div>';
	$content .=	'</form>';
	$content .=	'</span>';
	
	echo $content;
}
else {	
	
	$nom = $_POST["name"];
	$prenom = $_POST["firstname"];
	$email = $_POST["email"];
	$object = $_POST["subject"];
	$message = $_POST["message"];
	
	$message = htmlentities($message);
	$adresse="jonathandelefortrie@gmail.com";
	
	$from  = "From:" . $prenom . $nom . "<" . $email . ">\r\n";
	$from .= "Reply-To:" . $prenom . $nom . "<" . $email . ">\n";
	$from .= "X-priority:3\n";
	$from .= "MIME-Version: 1.0\r\n";
	$from .= "Content-Type: text/html";
	
	$texte  = "<html>" . $message . "</html>";
	
	mail($adresse,$object,$texte,$from);
	
	$content  = '<span id="content-contact" class="content-contact">';
	$content .=	'<div class="reponse-mail">';
	$content .= 'THE EMAIL HAS BEEN SENT ...';
	$content .=	'</div>';
	$content .=	'</span>';
	
	echo $content;
}
?>
