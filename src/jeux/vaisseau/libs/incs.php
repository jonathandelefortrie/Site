<?php
header('Content-type: text/html; charset=UTF-8');
import_request_variables("GPC");
session_start();
//sécurisation des postages
$_POST = secure_sql_string($_POST);
function secure_sql_string($str){
  if(is_array($str)){
    foreach($str as $key=>$value){
      $str[$key] = secure_sql_string($value);
    }
  }else{
    $str = my_real_escape_string($str);
  }
  return $str;
}

function my_real_escape_string($str){//protection injections javascript
  return strtr($str, array(
  "\x00" => '\x00',
  "\n" => '\n',
  "\r" => '\r',
  '\\' => '\\\\',
  "'" => "\'",
  '"' => '\"',
  "\x1a" => '\x1a'));
} 
//gestion de la langue et de son changement
//gestion de la langue et de son changement dalang-->>gestion des langues, ca ne detect pas en fonction des navigateurs
/*if ($dalang) $_SESSION['dalang']=$dalang;

if($_GET['dalang'] && !$_POST['dalang']) $_POST['dalang'] = $_GET['dalang'];

if($_POST['dalang']) $_SESSION['dalang']=$_POST['dalang'];*/

if (!isset($_SESSION['dalang'])) $_SESSION['dalang']='fr';
include("configuration.php");
include("addons.php");
include_once("html.php");
include_once("sgbd.class.php");
$mconf=mysqlconf();
  if($_SERVER['HTTP_HOST']=="ccccc"){
    $SGBD = new SGBD_Class(array("host"=>"127.0.0.1","user"=>"cccc","password"=>"cccc","dbname"=>"spade"));
  }else{
    $SGBD  = new SGBD_Class(array("host"=>$mconf["serveur"],"user"=>$mconf["login"],"password"=>$mconf["pass"],"dbname"=>$mconf["base"]));
  }
//if (eregi("administration", $_SERVER['REQUEST_URI'])){
//   print('Adios');
//   exit;
//}

//$SGBD->connect();

?>
