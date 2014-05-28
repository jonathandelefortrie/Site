<?php
header('Content-type: application/json');

$datas = "({'datas':[";
$tmp_data = Array();
$tmp_data[] = "{'name':'".$_REQUEST['name']."','score':'".$_REQUEST['score']."','time':'".$_REQUEST['time']."'}";
$datas .= implode(",",$tmp_data);
$datas .= "]})";
echo $_GET["jsoncallback"].$datas;
?>