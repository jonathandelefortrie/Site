<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="../css/layout-home.css" type="text/css" />
  <style type="text/css" media="screen">
    div {
      padding:0 0 0 15px;
    }
    hr {
      border-color :#d2d2d1;
    }
    .title {
      color:#5c5b5b;
    	font-size:11.5px;
    	letter-spacing:0.5px;
    	font-family :'Helvetica-Neue-Medium-Condensed';
    	display:inline-block;
    }
    .subtitle {
      color:#32859e;
    	font-size:11.5px;
    	letter-spacing:0.5px;
    	font-family :'Helvetica-Neue-Medium-Condensed';
    	display:inline-block;
    }
  </style>
</head>
<body>
<?php

$url = '';
$datasArray = array();

require_once 'data.php';

foreach ($datasArray as $data) {
	foreach ($data as $key => $value) echo '<div class="title">' . ucfirst($key) . ' : <p class="subtitle">' . $value . '</p></div>&nbsp';
	echo '<hr>';
}
?>

</body>
</html>
