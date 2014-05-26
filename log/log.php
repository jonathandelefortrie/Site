<?php

$i = 0;
$url = 'log/';
$datasArray = array();

require_once 'data.php';
require_once 'xml.php';

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$user_time = $_SERVER['REQUEST_TIME'];
$user_ip = $_SERVER['REMOTE_ADDR'];

if(strpos($user_agent, 'Firefox')==true) $nav="Firefox";
if(strpos($user_agent, 'MSIE')==true) $nav="Internet explorer";
if(strpos($user_agent, 'MSIE 5')==true || strpos($user_agent, 'MSIE 6')==true || strpos($user_agent, 'MSIE 7')==true || strpos($user_agent, 'MSIE 8')==true) $nav="Internet explorer old";
if(strpos($user_agent, 'WebKit')==true) $nav="Safari";
if(strpos($user_agent, 'Opera')== true) $nav="Opera";

$ip = str_replace('.', ' ', $user_ip);
$time = date("Y-m-d H:i:s", $user_time);

$newArray = array();

$newArray['time'] = $time;
$newArray['nav'] = $nav;
$newArray['ip'] = $ip;

foreach ($datasArray as $datas) {
  $i++;
	foreach ($datas as $key => $value) {
	
		if($key == "ip" && $value == $newArray['ip']) unset($datasArray[$i-1]);
    
	}
}

array_push($datasArray, $newArray);

//var_dump($datasArray);

xmlDatas($datasArray);

?>
