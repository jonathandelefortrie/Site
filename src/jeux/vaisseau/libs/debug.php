<?php

// affiche un debug complet des erreurs
// avec nom du fichier et numéro de ligne où se trouve l'erreur
function BackTraceDebug(){
			$backtrace = debug_backtrace();

			$next = "<b><font color=red>>></font></b> ";

			$num=1;
			$txt = "<br><b><font color=blue>BackTrace</font></b><br>".$num.$next;

			$tot = sizeof($backtrace)-1;
			for($i=$tot;$i>0;$i--){
				$num++;
				$args="";
				$ag=$backtrace[$i]['args'];

				if(gettype($ag)=="array"){
					$tmp=array();
	  				foreach($ag as $arg){
	  				  
	  				  if(gettype($arg)=='object'){
                array_push($tmp,'Object');
              }else if(gettype($arg)=="array"){
	  						array_push($tmp,print_r($arg,true));
	  					}else{
	  						array_push($tmp,$arg);
	  					}
	  				}
	  				$ag = $tmp;
					$args = '<font color=#2277BB>`'.implode('`</font> , <font color=#2277BB>`',$ag);
					$args.='`</font>';
				}

				if($backtrace[$i]['class']){
					$page = array_pop(explode("/",$backtrace[$i]['file']));
					$txt .= "(".$page." Ligne ".$backtrace[$i]['line'].") ".$backtrace[$i]['class'].$backtrace[$i]['type'];
				}

				$txt .= "<i><font color=#BB7722>" . $backtrace[$i]['function'] . "</font>($args)</i>";
				if($i>1) $txt .= "<br>".$num.$next;
			}

			return $txt."<br><br>";
}

// date actuelle en secondes + decimales
function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

if (!function_exists("stripos")){
	function stripos($str,$find,$offset=0){
		return strpos(strtolower($str),strtolower($find),$offset);
	}
}

?>
