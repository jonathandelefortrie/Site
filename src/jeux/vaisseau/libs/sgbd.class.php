<?php
/*
require_once("strings.php");
require_once("arrays.php");
*/
require_once("debug.php");

class SGBD_Class
{
	var $host = "";		// nom du serveur mysql
	var $user = "";		// login de connection au serveur
	var $password = "";	// mot de passe de connection au serveur

	var $dbName = "";	// nom de la base de donnée

	var $debug = 1;			// affichage des message de debug des requetes 0=OFF - 1=ON - 2=details
	
	var $debugBuffer = "";		// contenu des messages de debug
	var $queryCount = 0;		// nombre total de requetes
	var $queryTime = 0;			// durée totale des requetes en secondes
	var $queryErrorCount = 0;	// nombre de requetes qui ont échouées
	var $queryCountDebug = array();	// comptage des requetes par type(insert, select, count, update, etc...)
	var $queryTimeDebug = array();	// durée total de chaque type de requete

	// stockage de la liste des tables pour limiter les requetes
	
	var $linkSQL = 0;			// pointeur vers la connection sql
	var $last_insert_id = 0;	// valeur du dernier ID créé via une requete INSERT

	var $_LastCount = 0;		// nombre total de lignes (sans le limit) de la dernière requete effectuée dans getTabledata

	var $lastQuery;				// résultat de la dernière requete effectuée

	var $_SubSqlMode = false;	// false = requetes imbriquées faites avec PHP
								// true  = requetes imbriquées faites avec MYSQL 4.1
								
	var $_splitQueryLabel = array();
	var $_splitQueryCount = array();
	var $_splitQueryTime = array();
	
	var $_pdo=false; // lien vers la connection PDO
	
	var $connected = false;
	
	var $_LastLimitStart = 0;
	var $_LastLimitCount = 0;
	var $_pagesGenerationAllowed = false;
	/**
	 * _init
	 * @param array $params Tableau de données contenant les paramètres de connection au serveur SQL
	 * @return void ne retourne rien
	 */
	function SGBD_Class($params = array()){
		$this->host = $params['host'];
		$this->user = $params['user'];
		$this->password = $params['password'];
		
		if(isset($params['dbname'])) $this->dbName = $params['dbname'];

	}

	// Définition du niveau de debug
	// 0 = OFF
  // 1 = ON
  // 2 = details
	function debugLevel($level){
		$this->debug = $level;
	}

  // indique si la connection est déjà faite
  function is_connected(){
    return $this->connected;
  }
  
	// connection à MYSQL
	function connect($pdolink = false){
    if($pdolink == false){
  		if(function_exists("mysql_ping")){
  			if(@mysql_ping($this->linkSQL)){
  				mysql_close($this->linkSQL);
  			}
  		}else{
  			@MYSQL_CLOSE();
  		}
      
  		$this->linkSQL = mysql_connect($this->host, $this->user, $this->password) or die("<font color = red>Could not connect to MYSQL server</font>");
		  if($this->dbName) $this->_setDB($this->dbName);
		  
		  // gestion des requetes en UTF8
		  $this->query('SET NAMES UTF8');
		  
    }else{
      // connection PDO
      if($this->_pdo == false){
        $this->_pdo = $pdolink;
        
        // gestion des requetes en UTF8
        $this->query('SET NAMES UTF8');
      }
    }
    $this->connected = true;
	}

  
  // déconnection
  function close(){
    $this->disconnect();
  }
  function disconnect(){
    if($this->_pdo==false){
      $test = @mysql_close($this->linkSQL);
  		if(function_exists("mysql_ping")){
  			if(@mysql_ping($this->linkSQL)) $test = @mysql_close($this->linkSQL);
  		}
  		unset($this->linkSQL);
    }else{
      $this->_pdo = null;
    }
    $this->connected = false;
  }
  

	// sélection de la base à utiliser
	function _setDB($dbname){

		if($dbname == "") return false;

		$this->dbName = $dbname;

    // vérification que l'existance d'un connection précédente
		if(function_exists("mysql_ping")){
			$test = mysql_ping($this->linkSQL);
			if(!$test) $this->linkSQL = $this->_connect();
		}

		$query = "use ".$dbname.";";
		$result = MYSQL_QUERY($query);
		if(!$result) $this->debugBuffer.= "<font color = red>Error selecting <b>$dbname</b></font><br>";

		return $result;
	}// _setDB
	
	// affichage du debug
	function printDebug(){

	  $this->disconnect();

		$this->debugBuffer = "<table border=1><tr><td>".$this->debugBuffer;
		
		$this->_splitQueryInfo("R&eacute;sultat SQL");
		
		if(count($this->_splitQueryCount)>0){
			$tmp_count = 0;
			$tmp_time = 0;
			foreach($this->_splitQueryCount as $key=>$cnt){
				$this->debugBuffer .= $this->_splitQueryLabel[$key].": ".$cnt." req. en ".round($this->_splitQueryTime[$key],5)." s<br>";
				$tmp_count += $cnt;
				$tmp_time += $this->_splitQueryTime[$key];
			}
			$this->queryCount = $tmp_count;
			$this->queryTime = $tmp_time;
		}
		if(count($this->_splitQueryCount)>1){
			$this->debugBuffer .= "<hr>Total : ".$this->queryCount." req. en ".round($this->queryTime,5)." s";
		}
		
		if($this->queryErrorCount==1){
			$this->debugBuffer .= "<br><font color=red>".$this->queryErrorCount." erreur</font>";
		}else if($this->queryErrorCount>1){
			$this->debugBuffer .= "<br><font color=red>".$this->queryErrorCount." erreurs</font>";
		}

		if($this->debug > 1){
			$this->debugBuffer .= "<br>Details : <br>";

			foreach($this->queryCountDebug as $key=>$value){
				$pcount = floor(($value / $this->queryCount) * 100);
				$ptime = floor(($this->queryTimeDebug[$key] / $this->queryTime) * 100);
				$this->debugBuffer .= $key." : ".$value." req. ($pcount%) en ".round($this->queryTimeDebug[$key],5)." s($ptime%)<br>";
			}
		}
		$this->debugBuffer .= "</td></tr></table>";

		echo $this->debugBuffer;
	}

	function _splitQueryInfo($label=""){
		if($this->queryCount>0){
			array_push($this->_splitQueryLabel , $label);
			array_push($this->_splitQueryCount , $this->queryCount);
			array_push($this->_splitQueryTime , $this->queryTime);
			$this->queryCount = 0;
			$this->queryTime = 0.0;
		}
	}

  // retourne un tableau pour générer les pages d'une requete avec plusieurs résultats triés par pages
  function get_pages($extrem_count = 4,$middle_count = 2){
    $pages = array();

    
      $aStart = $this->_LastLimitStart;
      $aCount = $this->_LastLimitCount;
      $aTotal = $this->_LastCount;

      $max_display_count = ($extrem_count*2)+($middle_count*2)+1;
      
      if($aCount>0){
        $current_page = floor($aStart/$aCount);
        $page_count = ceil($aTotal/$aCount);
      }else{
        $aCount = $aTotal;
        $page_count = 1;
      }
      
    if($this->_pagesGenerationAllowed){
      $lString = '';

      if($page_count>1){
        
        if($current_page>$page_count) $current_page = 0;
        
        $pages_id = array();
        
        if($page_count<$max_display_count){
          for($i=0;$i<$page_count;$i++){
             array_push($pages_id,$i);
          }
        }else if($current_page>$page_count-($extrem_count+($middle_count*2)+1)){
          // pages du début
          for($i=0;$i<$extrem_count;$i++){
             array_push($pages_id,$i);
          }
          
           // pages de la fin
          $lStart = $page_count-($extrem_count+($middle_count*2)+1);
          if($lStart<$i){
            $lStart = $i;
          }else{
            array_push($pages_id,"_");
          }
          for($i=$lStart;$i<$page_count;$i++){
             array_push($pages_id,$i);
          }
          
        }else{
        
          // pages du début
          for($i=0;$i<$extrem_count;$i++){
             array_push($pages_id,$i);
          }
          
          // pages du milieu
          $lStart = $current_page - $middle_count;
          if($lStart<$i){
            $lStart = $i;
          }else{
            array_push($pages_id,"_");
          } 
            
          $lCount = $lStart+($middle_count*2)+1;
          for($i=$lStart;$i<$lCount;$i++){
             array_push($pages_id,$i);
          }
          
          // pages de la fin
          $lStart = $page_count-$extrem_count;
          if($lStart<$i){
            $lStart = $i;
          }else{
            array_push($pages_id,"_");
          }
          for($i=$lStart;$i<$page_count;$i++){
             array_push($pages_id,$i);
          }
        }
        
        

        
        $lastkey = sizeof($pages_id)-1;
         foreach($pages_id as $key=>$page_num){
            
            if(trim($page_num)!="_"){
              
              $label =  ($page_num+1);

              if($current_page==$page_num){
               
                $pages_id[$key] = array('label'=>$label,'start'=>$page_num*$aCount,'current'=>true);
              }else{
    
                $pages_id[$key] = array('label'=>$label,'start'=>$page_num*$aCount);
              }
              
            }
         }
        
        if($page_count>=$max_display_count || $page_count>1){
          if($current_page>0){
            $btn = array('label'=>'<','start'=>($current_page-1)*$aCount);
            array_unshift($pages_id,$btn);
          }
          
          if($current_page<$page_count-1){
            $btn = array('label'=>'>','start'=>($current_page+1)*$aCount);
            array_push($pages_id,$btn);
          }
        }
      }
      
      $pages = array('resultcount'=>$aTotal,'resultperpage'=>$aCount,'pagescount'=>$page_count,'pages'=>$pages_id);
      
    }
    return $pages;
  }


	// exécution d'une requete
	// retourne la resource du résultat de la requete ou false si elle a échouée
	function query($q = "",$debug = false){
    $q = trim($q);
		if($q == '') return false;

		if(!$debug) $debug = $this->debug;

    // connection à la base
    $rows_affected=0;
    $success=false;
		$now = microtime_float();
		if($this->_pdo!=false){
		 
  		  $deb = trim(strtolower(array_shift(explode(' ',$q))));
  		  $success = true;
  		  
  		  if($debug){
  		    echo '<hr>action=' .($deb == 'select').'<hr>';
  		  }
  		  
        if($deb == 'select'){
          /*
          try {
  		      $stmt = $this->_pdo->query($q);
  		      $success = $stmt!=false;
  		    }
  		    catch(PDOException $e)
          {
            $this->queryErrorCount++;
            $this->debugBuffer .= "<hr>PDO ERROR!<hr>".$e->getMessage();
            $success = false;
          }
          */
  		    if($debug){
  		      echo '<hr>PDO select :'.$deb;
  		    }
  		    
  		    if($success){
    		    $r = array();
    		    while($line = $stmt->fetch(PDO::FETCH_ASSOC)){
    		      if(sizeof($line)==1){
    		        array_push($r,current($line));
              }else{
                array_push($r,$line);
              }
            }
            $stmt->closeCursor();
          }
        }else{
          
          if($debug){
  		      echo '<hr>PDO exec :'.$deb;
  		    }
  		    $r=true;
  		    /*
  		    try {
            $rows_affected = $this->_pdo->exec($q);
          }
  		    catch(PDOException $e)
          {
            $this->queryErrorCount++;
            $this->debugBuffer .= "<hr>PDO ERROR!<hr>".$e->getMessage();
            $success = false;
            $r=false;
          }
          */
          
        }
    }else{
      $r = MYSQL_QUERY($q);
      if($r) $success = true;    
    }
		$elapsed = (microtime_float() - $now);
		
		$this->queryTime += $elapsed;

		$err_mess = "";

		$this->_pagesGenerationAllowed = false;
		
		if($success){
		  // dans le cas d'un insert, récupération de l'ID généré
		  if(strtolower(substr($q,0,6))=="insert"){
		    if($this->_pdo==false){
  		    $this->last_insert_id = mysql_insert_id();
        }else{
          $this->last_insert_id = $this->_pdo->lastInsertId();
        }
      }
      
      // si on a demandé de calculer le total d'éléments trouvés
      // dans le cas d'une requete au nombre retours limité,
      // récupération de cette valeur
      
			if(stripos($q,"SQL_CALC_FOUND_ROWS")!==false){
        if($this->_pdo==false){
  				$rc = MYSQL_QUERY("SELECT FOUND_ROWS()");
  				$rc = mysql_fetch_array($rc,MYSQL_ASSOC);
  				$this->_LastCount = current($rc);
  			}else{
  			  $stmt = $this->_pdo->query("SELECT FOUND_ROWS()");
  			  $cnt = current($stmt->fetch(PDO::FETCH_ASSOC));
          $this->_LastCount = $cnt;
        }
        // récupération des valeurs de limitation de la requete
        $tmp = explode('limit',strtolower($q));
        $values = explode(',',array_pop($tmp));
        
        if(sizeof($values)==1){ // LIMIT count
          $this->_LastLimitStart = 0;
          $this->_LastLimitCount = floor(trim($values[0]));
        }else{ // LIMIT start,count
          $this->_LastLimitStart = floor(trim($values[0]));
          $this->_LastLimitCount = floor(trim($values[1]));
        }
        $this->_pagesGenerationAllowed = true;

			}else{
				$this->_LastCount = 0;
				if($this->_pdo==false){
				  if(is_resource($r))	$this->_LastCount = mysql_num_rows($r);
				}else{
				  if(is_array($r)){
				    if(is_array(current($r))){
				      $this->_LastCount = count($r);
            }else{
              $this->_LastCount = 1;
            }
          }
        }
			}
			
			if($debug){
				$this->debugBuffer .= (nl2br('<hr><font size=1 face=Arial color=green>'.$q.'</font><br>'.$rows_affected.' lignes mises à jour'));
			}
			$this->queryCount++;
			
		}else{
		  if(strtolower(substr($q,0,6))=="insert") $this->last_insert_id = "error";
			// si la requete a échouée, on affiche toujours un debug complet de ce qui s'est passé
			$r = false;
			$err =  mysql_error();
			$err_mess = nl2br('<hr><font size=1 face=Arial color=red><b>Error</b> : <br>'.$q.'<br><br>'.$err.'</font><br>');
			$this->debugBuffer .= $err_mess; 
			if($this->debug < 2){ // on affiche pas cette info en mode debug détaillé car elle est déjà affichée ailleurs
				$this->debugBuffer .= "<b>La requete a &eacute;chou&eacute;e.</b><br>";
				$this->debugBuffer .= BackTraceDebug();
			}
			$this->queryErrorCount++;
			
			if(strlen($this->debugBuffer)>4096*8){
        $this->debugBuffer = '';
      }
		}
				
		// ajout des infos de debug simples
		if($debug){
			// récupération du type de requete (select, update, etc...)
			$tmp = explode(" ",trim($q));
			$mot = strtoupper($tmp[0]);
			// cas spécial pour les requetes "select count(*)..."
			if(substr($tmp[1],0,5)=="count" || substr($tmp[2],0,5)=="count"){
				$mot = "SELECT_COUNT";
			}

			$this->queryCountDebug[$mot]++;
			$this->queryTimeDebug[$mot] += $elapsed;
		}

		// ajout des infos de debug complètes
		if($this->debug > 1 ){
		
			if($r){
				if(gettype($r) == "boolean"){
					$this->debugBuffer .= "Requete r&eacute;ussie en ".round($elapsed,5)." s.<br>";
				}else{
					$this->debugBuffer .= mysql_num_rows($r)."/".$this->_LastCount." r&eacute;sultats en ".round($elapsed,5)." s.<br>";
				}
			}else{
				$this->debugBuffer .= "<b>La requete a &eacute;chou&eacute;e.</b><br>";
			}

			$this->debugBuffer.=BackTraceDebug();
		}

		$this->lastQuery = $r;
		
		return $r;
	}// query


	// execution d'une requete qui ne retourne qu'une valeur
	function queryValue($q = "",$debug = false){

		if($q == "") return false;

		if(!$debug) $debug = $this->debug;

		$r = $this->query($q,$debug);
		
		if(strtolower(substr($q,0,6))!='select'){
      $this->debugBuffer.="<font size=1 face=Arial color=orange><b>WARNING</b> : wrong use of _queryValue()</font><br>";
      $this->debugBuffer.=BackTraceDebug();
      $this->debugBuffer.='<hr>';
      return $r;
    }
		
		if($r){
		  if($this->_pdo){
		    $value = $r;
      }else{
        $value = mysql_fetch_array($r);
        // on libère la mémoire
			   mysql_free_result($r);
      }
			
			
		}else{
			$value = false;
		}
		
		if($value){
			$value = current($value);
			$this->lastQuery = $value;
			return $value;
		}else{
			$this->lastQuery = false;
			return false;
		}
	}// queryValue




	// execution d'une requete qui ne retourne qu'une ligne de champs, sous la forme d'un tableau de données
	function queryLine($q = "", $debug = false){

		if($q == '') return false;

		if(!$debug) $debug = $this->debug;

		$r = $this->query($q,$debug);
    
    if($r==1){
      $this->debugBuffer.="<font size=1 face=Arial color=orange><b>WARNING</b> : wrong use of queryLine()</font><br>";
      $this->debugBuffer.=BackTraceDebug();
      $this->debugBuffer.='<hr>';
      return $r;
    }
    
		if($r){
		  if($this->_pdo){
		    $line = current($r);
      }else{
        $line = mysql_fetch_array($r,MYSQL_ASSOC);
       // on libère la mémoire
			 mysql_free_result($r);
      }
      			

			if($line){
				$this->lastQuery = $line;
				return $line;
			}else{
				$this->lastQuery = false;
				return false;
			}
		}else{
			$this->lastQuery = false;
			return false;
		}
	}// queryLine
  
  // retourne un tableau contenant tous les résultats de la requete formatés pour etre utilisés dans un select
  // $keyname = nom du champ à être utilisé comme clé d'identification/valeur
  // $displayname = nom du champs qui sera affiché dans le select
  // $firstblank = afficher une valeur vide en début de liste (peut être une chaine à afficher à la place du vide)
  
  function queryListForSelect($q = "" , $keyname , $displayname, $firstblank = false,$debug=false){
    $liste = $this->queryList($q,$debug);
    
    if($firstblank!=false){
      if(is_string($firstblank)){
        $liste = array_merge(array(0=>$firstblank),$liste);
      }else{
        $liste = array_merge(array(0=>""),$liste);
      }
    }
    
    $data = array();
    foreach($liste as $values){
      $data[$values[$keyname]] = $values[$displayname];
    }

    return $data;
  }
  
	// retourne un tableau contenant tous les résultats de la requete
	function queryList($q = "" , $debug = false){
		if($q == "") return false;

		if(!$debug) $debug = $this->debug;

		
    $r = $this->query($q,$debug);
		
    
    if($r==1){
      $this->debugBuffer.="<font size=1 face=Arial color=orange><b>WARNING</b> : wrong use of queryList()</font><br>";
      $this->debugBuffer.=BackTraceDebug();
      $this->debugBuffer.='<hr>';
      return $r;
    }
    

		if($r){
		  $tmp = array();
		  
      if($this->_pdo){
        
        $tmp = $r;

      }else{
			
  			while($line = mysql_fetch_assoc($r)){
  				
          if(sizeof($line)==1){
  					array_push($tmp,current($line));
  				}else{
  					array_push($tmp,$line);
  				}
  			}
  
  			// on libère la mémoire
  			mysql_free_result($r);
      }
			
			$this->lastQuery = $tmp;

			return $tmp;

		}else{
			$this->lastQuery = array();
			return array();
		}
	}
  
  // purge de la dernière requete
  function freeResult(){
    if($this->_pdo==false){
      if(is_resource($this->lastQuery)) mysql_free_result($this->lastQuery);
    }

    $this->lastQuery = false;
  }
  
  
	// retourne un tableau contenant tous les résultats de la requete
	// avec un tableau par champ
	function queryListAssoc($q = "" , $debug = false){
		if($q == "") return false;

		if(!$debug) $debug = $this->debug;

		$r = $this->query($q,$debug);
    
    if($r==1){
      $this->debugBuffer.="<font size=1 face=Arial color=orange><b>WARNING</b> : wrong use of queryListAssoc()</font><br>";
      $this->debugBuffer.=BackTraceDebug();
      $this->debugBuffer.='<hr>';
      return $r;
    }
    
		if($r){
			$tmp = array();
			$keys = false;
			while($line = mysql_fetch_array($r,MYSQL_ASSOC)){
				if($keys==false){
					$keys = array_keys($line);
					foreach($keys as $k){
						$tmp[$k] = array();
					}
				}
				
				foreach($keys as $k){
					array_push($tmp[$k],$line[$k]);
				}
			}
			// on libère la mémoire
			mysql_free_result($r);
			
			if(sizeof($tmp)>0){
				$this->lastQuery = $tmp;
				return $tmp;
			}else{
				$this->lastQuery = false;
				return false;
			}
		}else{
			$this->lastQuery = false;
			return false;
		}
	}

  // retourne la liste des champs d'une table donnée
  function tableFieldList($tableName){
    $data = $this->queryList("SHOW COLUMNS FROM $tableName");
    $final = array();
    foreach($data as $line){     
      array_push($final,$line['Field']);
    }
    
    return $final;
  }

  // retourne les informations complètes des champs d'une table donnée
  function tableData($tableName,$file_fields=array()){
    $data = $this->queryList("SHOW FULL COLUMNS FROM $tableName");
    $final = array();
    foreach($data as $line){
      
      $pos = strpos($line['Type'],"(");
      if($pos!==false){
        $type = substr($line['Type'],0,$pos);
        $size = 0;
        switch($type){
          case "enum":
            $size = $this->parse_enum($line['Type']);
          break;
          
          default:
          $pos2 = strpos($line['Type'],")");
          $size = substr($line['Type'],$pos+1,$pos2-($pos+1));
        }
      }else{
        $type = $line['Type'];
      }
      if(in_array($line['Field'],$file_fields)) $line['Comment'] = "file";
      $final[$line['Field']] = array("field"=>$line['Field'],"type"=>$type,"size"=>$size,"extra"=>$line['Extra'],"comment"=>$line['Comment']);
                 
    }
    
    return $final;
  }

  function parse_enum($str) {
    $reg = "^enum\('(.*)'\)$";
    $str = ereg_replace($reg,'\1',$str); 
    $str = "','".str_replace("''","'",$str);
    $liste = explode("','",$str);
    return $liste;
  } 
  
  // retoune une liste
  function idListToFieldList($liste,$table,$field){
    if(is_string($liste)){
      if(substr($liste,-1)==",") $liste = substr($liste,0,strlen($liste)-1);
      $liste = explode(",",$liste);
    }
    $liste = array_unique($liste);
    
    $q = "SELECT DISTINCT $field FROM $table WHERE id IN(".implode(",",$liste).") ";
    return $this->queryList($q);
  }
  

	// retourne la valeur de l'ID de la derniere requete INSERT effectuée
	function lastInsertId(){
		return $this->last_insert_id;
	}
  function lastid(){
		return $this->last_insert_id;
	}

	// affiche un message d'erreur
	function error($message){
		echo "<hr><font color=red>".$message."</font><br>";
	}


  function searchList($table,$search=array(),$testlist=array(),$orderby=array(),$limitstart=0,$limitcount=15){

    $tableData = $this->_tableData($table);
    
    $champs = array("$table.*");
    $from = array($table);
    $where = array();
    
    foreach($tableData as $fieldData){
      if($fieldData['extra']==''){
        
        if(substr($fieldData['field'],0,3)=="id_"){
          // clé étrangère
          
          $tableEtrangere = substr($fieldData['field'],3,strlen($fieldData['field'])-3);
          
          if(strpos($fieldData['type'],"char")!==false){
            // liste de clé étrangères
            if(isset($search[$fieldData['field']]) && $search[$fieldData['field']]!=""){
              $tmplst = explode(" ",$search[$fieldData['field']]);
              $lst = array();
              
              foreach($tmplst as $tmp){
                if(tmp!="") array_push($lst," $tableEtrangere.nom LIKE \"%".stripslashes($tmp)."%\" ");
              }
              if(count($lst)>0){
                array_push($from,$tableEtrangere);
                array_push($where,"$tableEtrangere.id IN ($table.".$fieldData['field'].") AND (".implode(" OR ",$lst).")");
                array_push($champs,$tableEtrangere.".nom");
              }
              unset($search[$fieldData['field']]);
              //$search[$fieldData['field']] = $gMysql->queryList("SELECT DISTINCT nom FROM $tableEtrangere WHERE ".implode(" OR ",$lst)." ");
            }
            
            if(isset($orderby[$fieldData['field']])){
              array_push($from,$tableEtrangere);
              $orderby = renameKey($orderby,$fieldData['field'],$tableEtrangere.".nom");
            } 
            
          }else{
            // une seule clé étrangère
            
            if(isset($search[$fieldData['field']]) && $search[$fieldData['field']]!=""){
              array_push($from,$tableEtrangere);
              array_push($where,"$tableEtrangere.id = $table.".$fieldData['field']." AND ($tableEtrangere.nom LIKE \"%".stripslashes($search[$fieldData['field']])."%\")");
              array_push($champs,$tableEtrangere.".nom");
              
              unset($search[$fieldData['field']]);
              //$search[$fieldData['field']] = $gMysql->queryValue("SELECT DISTINCT id FROM $tableEtrangere WHERE nom LIKE \"%".$search[$fieldData['field']]."%\" ");
            }
            if(isset($orderby[$fieldData['field']])){
              array_push($from,$tableEtrangere);
              $orderby = renameKey($orderby,$fieldData['field'],$tableEtrangere.".nom");
            }
          }
                  
        }else{
          // champs quelconque            
          
          if($fieldData['type']=="date"){
            $jour = substr("00".$search[$fieldData['field']."_j"],-2);
            $mois = substr("00".$search[$fieldData['field']."_m"],-2);
            $annee = substr("0000".$search[$fieldData['field']."_a"],-4);
            
            unset($search[$fieldData['field']."_j"]);
            unset($search[$fieldData['field']."_m"]);
            unset($search[$fieldData['field']."_a"]);
            $date = $annee."-".$mois."-".$jour;
            
            if($date!="0000-00-00" && $annee>0) $search[$fieldData['field']] = $date;
          }
          
        }     
      
      }else{
        // champ id      
      }
          
    }
    $from = array_unique($from);
    $q = "SELECT DISTINCT SQL_CALC_FOUND_ROWS ".implode(",",$champs)." FROM ".implode(",",$from)." ";
    
    
    foreach($search as $field=>$value){
      if(is_array($value)){
        // liste de clé étrangères
        array_push($where,"($field IN (".implode(",",$value)."))");
      }else{
        switch($tableData[$field]['type']){    
          default:
          $op="=";
          if(isset($testlist[$field])) $op = $testlist[$field];
          if($value!="") array_push($where,"(".$field.$op."'".$value."')");
        }
      }
    }
    
    if(count($where)>0){
      $q.=" WHERE ";   
      $q.= implode(" AND ",$where);    
    }
    
    $tmp = array();
    foreach($orderby as $field=>$mode){
      array_push($tmp, $field." ".$mode);
    }
    if(count($tmp)>0) $q.= " ORDER BY ".implode(", ",$tmp);
    
    $q .= " LIMIT $limitstart,$limitcount ";
    print $q."<hr>";
    
    $resultat = array();
    
    $resultat['table'] = $table;
    $resultat['liste'] = $this->queryList($q);
    $resultat['total'] = $this->_LastCount;
    
    return  $resultat;
  }
  
  

  
}// class


?>
