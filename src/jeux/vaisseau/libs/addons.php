<?php

function gladalle($x,$y){
	global $SGBD;
	print "<table border=0>";
	$ix=0;
	$iy=0;
	$totdalle=$x*$y;
	$chemdalle=array();
	$tempix=0;
	//$des_images=$SGBD->queryList("SELECT * FROM block where type = '3' ORDER BY RAND() LIMIT ".$totdalle);
	//foreach($des_images as $line){
	// $tempix++;
	// $chemdalle[$tempix]=$line['content'];
	//}
	$des_images=$SGBD->queryList("SELECT * FROM photos ORDER BY RAND() LIMIT ".$totdalle);
	foreach($des_images as $line){
	 $tempix++;
	 $chemdalle[$tempix]=$line['chem'];
	}
  $tempix=0;
	for ($iy=0;$iy < $y; $iy++){
		
		print "<tr>";
		for ($ix=0;$ix < $x; $ix++){
		  $tempix++;
		  //$ladalle="../images/divers/";
			
      //$ladalle.=getFileName($chemdalle[$tempix]);
      $ladalle=$chemdalle[$tempix];
			$size = getimagesize($ladalle);
			$tx = $size[0];
	    $ty = $size[1];
	    if ($tx > $ty){
        if ($tx > 98){
          $stx=98;
          $sty=floor(98*$ty/$tx);
          if ($sty > 78){
            $sty=78;
            $stx=floor(78*$tx/$ty);
          }
          
        }else{
         $stx=$tx;
         $sty=$ty;
        }      
      }else{
        if ($ty > 78){
          $sty=78;
          $stx=floor(78*$tx/$ty);
          if ($stx > 98){
            $stx=98;
            $sty=floor(98*$ty/$tx);
            }
        }else{
         $stx=$tx;
         $sty=$ty;
        } 
        
      }
			print "<td width='102' height='82'><div style='";
			print "padding:1px 0;
-moz-border-radius: 4px;
-khtml-border-radius: 4px;
-webkit-border-radius: 4px;
width: 100px;
height: auto;
border: 2px solid black;
background:#FFFFFF;
z-index:13;
display: block; 
vertical-align: middle;
text-align: center;'>";
      print"<img src='".$ladalle."' border='0' width='".$stx."' height='".$sty."' align='center' valign='middle'></div></td>";
		}
		print "</tr>";
	}
	print "</table>";

}
function getFileExt($file){
	$file=explode(".",$file);
	$ext=$file[sizeof($file)-1];
	return $ext;
}

function getFilePath($file){
	$tmp=explode("/",$file);
	array_pop($tmp);
	$file = implode("/",$tmp)."/";
	return $file;
}

function getFileName($file){

	$tmp=explode("/",$file);
	$file=array_pop($tmp);

	return $file;
}
function file_to_image($file){
  $chemin=getFilePath($file);
	$fichier=getFileName($file);
	$ext=getFileExt($fichier);
		
	if($newpath=="") $newpath=$chemin;
		
	$source=false;
		
	if($ext=="jpg") $source = imagecreatefromjpeg($file);
	if($ext=="png") $source = imagecreatefrompng($file);
	if($ext=="bmp") $source = imagecreatefromwbmp($file);
	if($ext=="gif") $source = imagecreatefromgif($file);
		
	return $source;
}

function image_to_file($image,$file,$qualite=100){
  $chemin=getFilePath($file);
	$fichier=getFileName($file);
	$ext=getFileExt($fichier);
  if(file_exists($file)) unlink($file);
	if($ext=="jpg") return imagejpeg($image,$file,$qualite);
	if($ext=="gif") return imagegif($image,$file);
	if($ext=="png") return imagegif($image,$file);
	if($ext=="bmp") return imagewbmp($image,$file);
	return false;
}
function resize_image($chemin,$filename,$newsize=70,$newpath=""){
		
		$fichier=$chemin.$filename;
		
		$ext=strtolower(substr($filename,-3));

		$source="test";

		if($ext=="jpg") $source = imagecreatefromjpeg($fichier);
		if($ext=="png") $source = imagecreatefrompng($fichier);
		if($ext=="bmp") $source = imagecreatefromwbmp($fichier);
		if($ext=="gif") $source = imagecreatefromgif($fichier);

		 if($source!="test"){
		 	// dimensions de l'image
			$imageX = imagesx($source);
			$imageY = imagesy($source);
			
			if($imageX>$newsize || $imageY>$newsize){
				// redimensionnement
				if($imageX>$imageY){
					$h = floor($newsize*$imageY/$imageX);
					$w = $newsize;
				}else{
					$w = floor($newsize*$imageX/$imageY);
					$h = $newsize;
				}
				
				// création de l'image finale
				$dest  = imagecreatetruecolor($w, $h);
				 
				// copie de l'image source dans l'image finale
				imagecopyresampled ($dest, $source, 0, 0, 0, 0, $w, $h, $imageX, $imageY);
				
				// création du fichier final (objet image, fichier, qualité jpeg)
				$nom=getFilenameNoExt($filename);
				
				$nom=$chemin.$newpath.$nom.".jpg";
				
				if (!file_exists($chemin.$newpath)) mkdir($chemin.$newpath);
				
				imagejpeg($dest,$nom,95);
				 
				
				chmod($nom,0775);
				 
				imagedestroy($dest);
				imagedestroy($source);
				
				return $nom;
			}
		}
		return false;
}

function strtolower_utf8($string){
    
  $search  = array ('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ü','Ú','ß');
  $replace = array ('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ'); 
  $string  = str_replace($search, $replace, $string);
  $string  = strtolower(utf8_decode($string));

  return utf8_encode($string);
}


function strtoupper_utf8($string){
  
  $search  = array ('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ');
  $replace = array ('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ü','Ú','ß');
  $string  = str_replace($search, $replace, $string);
  $string  = strtoupper(utf8_decode($string));
  
  return utf8_encode($string);
}

function OLD_strtolower_utf8($string){
  $convert_to = array(
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
    "v", "w", "x", "y", "z", "Ã ", "Ã¡", "Ã¢", "Ã£", "Ã¤", "Ã¥", "Ã¦", "Ã§", "Ã¨", "Ã©", "Ãª", "Ã«", "Ã¬", "Ã­", "Ã®", "Ã¯",
    "Ã°", "Ã±", "Ã²", "Ã³", "Ã´", "Ãµ", "Ã¶", "Ã¸", "Ã¹", "Ãº", "Ã»", "Ã¼", "Ã½", "Ð°", "Ð±", "Ð²", "Ð³", "Ð´", "Ðµ", "Ñ‘", "Ð¶",
    "Ð·", "Ð¸", "Ð¹", "Ðº", "Ð»", "Ð¼", "Ð½", "Ð¾", "Ð¿", "Ñ€", "Ñ", "Ñ‚", "Ñƒ", "Ñ„", "Ñ…", "Ñ†", "Ñ‡", "Ñˆ", "Ñ‰", "ÑŠ", "Ñ‹",
    "ÑŒ", "Ñ", "ÑŽ", "Ñ"
  );
  $convert_from = array(
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
    "V", "W", "X", "Y", "Z", "Ã€", "Ã", "Ã‚", "Ãƒ", "Ã„", "Ã…", "Ã†", "Ã‡", "Ãˆ", "Ã‰", "ÃŠ", "Ã‹", "ÃŒ", "Ã", "ÃŽ", "Ã",
    "Ã", "Ã‘", "Ã’", "Ã“", "Ã”", "Ã•", "Ã–", "Ã˜", "Ã™", "Ãš", "Ã›", "Ãœ", "Ã", "Ð", "Ð‘", "Ð’", "Ð“", "Ð”", "Ð•", "Ð", "Ð–",
    "Ð—", "Ð˜", "Ð™", "Ðš", "Ð›", "Ðœ", "Ð", "Ðž", "ÐŸ", "Ð ", "Ð¡", "Ð¢", "Ð£", "Ð¤", "Ð¥", "Ð¦", "Ð§", "Ð¨", "Ð©", "Ðª", "Ðª",
    "Ð¬", "Ð­", "Ð®", "Ð¯"
  );

  return str_replace($convert_from, $convert_to, $string);
} 

function OLD_strtoupper_utf8($string){
  $convert_from = array(
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
    "v", "w", "x", "y", "z", "Ã ", "Ã¡", "Ã¢", "Ã£", "Ã¤", "Ã¥", "Ã¦", "Ã§", "Ã¨", "Ã©", "Ãª", "Ã«", "Ã¬", "Ã­", "Ã®", "Ã¯",
    "Ã°", "Ã±", "Ã²", "Ã³", "Ã´", "Ãµ", "Ã¶", "Ã¸", "Ã¹", "Ãº", "Ã»", "Ã¼", "Ã½", "Ð°", "Ð±", "Ð²", "Ð³", "Ð´", "Ðµ", "Ñ‘", "Ð¶",
    "Ð·", "Ð¸", "Ð¹", "Ðº", "Ð»", "Ð¼", "Ð½", "Ð¾", "Ð¿", "Ñ€", "Ñ", "Ñ‚", "Ñƒ", "Ñ„", "Ñ…", "Ñ†", "Ñ‡", "Ñˆ", "Ñ‰", "ÑŠ", "Ñ‹",
    "ÑŒ", "Ñ", "ÑŽ", "Ñ"
  );
  $convert_to = array(
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
    "V", "W", "X", "Y", "Z", "Ã€", "Ã", "Ã‚", "Ãƒ", "Ã„", "Ã…", "Ã†", "Ã‡", "Ãˆ", "Ã‰", "ÃŠ", "Ã‹", "ÃŒ", "Ã", "ÃŽ", "Ã",
    "Ã", "Ã‘", "Ã’", "Ã“", "Ã”", "Ã•", "Ã–", "Ã˜", "Ã™", "Ãš", "Ã›", "Ãœ", "Ã", "Ð", "Ð‘", "Ð’", "Ð“", "Ð”", "Ð•", "Ð", "Ð–",
    "Ð—", "Ð˜", "Ð™", "Ðš", "Ð›", "Ðœ", "Ð", "Ðž", "ÐŸ", "Ð ", "Ð¡", "Ð¢", "Ð£", "Ð¤", "Ð¥", "Ð¦", "Ð§", "Ð¨", "Ð©", "Ðª", "Ðª",
    "Ð¬", "Ð­", "Ð®", "Ð¯"
  );

  return str_replace($convert_from, $convert_to, $string);
} 

// retire les caractères spécifiés
function notfilter_string($t,$replace='',$limit="'\",.-/+*()_$!?:\\;&#{[|`^@]}~²"){
	$final="";
	for($i=0;$i<strlen($t);$i++){
		$pos=strpos($limit,substr($t,$i,1));
		if($pos === false){
				$final .=substr($t,$i,1);
		}else{
      $final .=$replace;
    }
	}
	return $final;
}

// conserve les caractères spécifiés
function filter_string($t,$limit="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"){
	$final="";
	for($i=0;$i<strlen($t);$i++){
		$pos=strpos($limit,substr($t,$i,1));
		if($pos === false){
				//
		}else{
			$final .=substr($t,$i,1);
		}
	}
	return $final;
}

// test si la chaine ne contient que les caractères spécifiés
function test_filter_string($t,$limit="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"){
	for($i=0;$i<strlen($t);$i++){
		$pos=strpos($limit,substr($t,$i,1));
		if($pos === false) return false;
	}
	return true;
}


// remplace toutes les lettres accentuées par des lettres sans accents
function remove_accents($text) {
	  // minuscules
    $search  = array ('à','á','â','ã','ä','å', 'æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ'); 
    $replace = array ('a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y');
    $text    = str_replace($search, $replace, $text);
    
    // majuscules
    $search  = array ('À','Á','Â','Ã','Ä','Å', 'Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ü','Ú','ß');
    $replace = array ('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','U','U','U','Y');
    $text    = str_replace($search, $replace, $text);
    
    return $text;
}

function daysToDate($d){
  $years = floor($d / 365);
  $months = floor(($d - ($years*365)) / 30);
  $days = $d - ($years * 365 + $months * 30);
  $output = '';
  if($years>0){
    $output.= $years.' an';
    if($years>1)  $output.= 's';
  }
  if($months>0){
    $output.= ' '.$months.' mois';
  }
  if($days>0){
    if($years>0 || $months>0) $output .= ' et';
    $output.= ' '.$days.' jour';
    if($days>1)  $output.= 's';
  }
  return $output;
}


function datetimestamp($d){
  if($d=='') $d='0000-00-00 00:00:00';
  $tmp = explode(' ',$d);
  
  $d = explode('-',$tmp[0]);
  $t = explode(':',$tmp[1]);
  
  
  return mktime($t[0],$t[1],$t[2],$d[1],$d[2],$d[0]);
  
}


function get_directory_listing($chemin = './'){
  if($chemin=='') $chemin=('./');
  
  
	$dirlist = array();
	$filelist = array();
	$filenames = array();
	
  if(file_exists($chemin)){
    $handle = opendir($chemin);  
    while ($file = readdir($handle)){
      if ($file != "." && $file != "..") {
      
  		  if(!is_file($chemin.$file)){
  				// rÃ©pertoire
  				array_push($dirlist,$file);
  			}else{
  			
  				$sz = @filesize($chemin.$file);
  				$sz2 = $sz;
  				$sz=human_filesize($sz);
  				
  				$filelist[$file] = array('name'=>$file,'size'=>$sz,'fullsize'=>$sz2);
  				array_push($filenames,$file);
  			}
  		}
    }
  	closedir($handle);
  
  	natsort($filenames);
  	$tmp = array();
  	foreach($filenames as $key){
      array_push($tmp,$filelist[$key]);
    }
  	
  	natsort($dirlist);
	}
	return array('directory'=>$dirlist,'file'=>$tmp);
}

function human_filesize($sz){
	if($sz<1024){
		$sz = $sz."Â Octets";
	}else if($sz<1024*1024){
		$sz = (round(($sz/1024)*100)/100)." Ko";
	}else if($sz>=1024*1024){
		$sz = (round(($sz/(1024*1024))*100)/100)." Mo";
	}
	
	return $sz;
}

function human_datetime($datetime){
  $tmp = explode(' ',$datetime);
  $date = explode('-',$tmp[0]);
  $date = $date[2].'/'.$date[1].'/'.$date[0];
  
  return trim($date.' '.$tmp[1]);
}

function computer_datetime($datetime){
  $tmp = explode(' ',$datetime);
  $date = explode('/',$tmp[0]);
  $date = $date[2].'-'.$date[1].'-'.$date[0];
  
  return trim($date.' '.$tmp[1]);
}

function valid_email($email) {
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }  
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

function Smail($email,$sujet,$message,$email_sender){
      $entete = "MIME-Version: 1.0\n";
      $entete .= "Content-type: text/plain; charset=utf-8\n";
      $entete .= "From: ".$email_sender." <".$email_sender.">\n";
      $entete .= "X-Sender: <".$_SERVER['SERVER_NAME'].">\n";
      $entete .= "X-Mailer: PHP\n";
      $entete .= "X-auth-smtp-user: ".$email_sender."\n";
      $entete .= "X-abuse-contact: ".$email_sender."\n"; 
			mail($email,$sujet,$message,$entete);
}
// Function: zipfile()
function zipfile($file){
	
	$nom=getFilenameNoExt($file);
	
	$p_zipname=$nom.".zip";

	$ext = new PclZip($p_zipname);

	$t= $ext->create($file,"","");

	return $t[0]["status"];
}

// Function: getFilenameNoExt()
function getFilenameNoExt($file){
	$file=explode(".",$file);
	array_pop($file);
	$file=implode(".",$file);
	return $file;
}

// Function: format_prix()
function format_prix($number=0,$xtra="&euro;"){
	$r=number_format($number, 2, ',', ' ');
	if(trim($xtra)!="") $r.=" ".$xtra;
	return $r;
}

// Function: style-width()
function style_width($w){
	return " style='width:".$w."px' ";	
}

function convmon($valeur,$dest="USD"){
$url = "http://www.google.fr/search?hl=fr&q=1+EUR+en+USD";
$file = fopen($url,"r");
 
if (!$file) { 
  $resultat = "error 1 "; 
} else {
    $txt = "";
    $resultat = "error2";  
    while (!feof ($file)) { 
         $txt.= fgets ($file, 1024); 
    }
    $txt = strip_tags($txt);
    $txt = str_replace(" ","",$txt);

    $pos_debut = stripos($txt,"euro");
    if($pos_debut!==false){
       
       // on s'assure d'être sur le bon couple "nom de devise" suivi d'un "="
      $cnt=0;
      $pos_egal = stripos($txt,"=",$pos_debut);
      while(($pos_egal - $pos_debut)>20 && $cnt<500){
        $pos_debut = stripos($txt,"euro",$pos_egal);
        $pos_egal = stripos($txt,"=",$pos_debut);
        $cnt++;
      }

      if($pos_egal!==false){
         $pos_egal += 1;
         
         $pos_fin = stripos($txt,$dest,$pos_egal);
         if($pos_fin!==false){
           $resultat = substr($txt,$pos_egal,$pos_fin - $pos_egal);
           $resultat = str_replace(",",".",$resultat);
           $resultat = str_replace(" ","",$resultat);
           $resultat = trim($resultat);
           $resultat = $resultat * $valeur;
         }
      }
    }
} 
fclose($file);
$resultat=130;
return $resultat;
}
// récupère un élément depuis une date formatée en "YYYY-MM-DD HH:MM:SS"
function getdatepart($date,$info){
	$t=explode(" ",$date);
	$d=explode("-",$t[0]);
	if(sizeof($t)>1){
		$h=explode(":",$t[1]);
	}else{
		$h=array();
	}

	switch (strtolower($info)){
		case "year":
			return $d[0];
			break;
		case "month":
			return $d[1];
			break;
		case "day":
			return $d[2];
			break;
		case "hour":
			return $h[0];
			break;
		case "minute":
			return $h[1];
			break;
		case "seconde":
			return $h[2];
			break;
		case "date":
			if(sizeof($d)>1){
				return $d[2]."-".$d[1]."-".$d[0];
			}else{
				return"";
			}
			break;
		case "time":
			return $t[1];
			break;
	}

	return false;
}
?>
