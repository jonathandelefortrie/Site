<?php

$dom = new DomDocument();
$dom->load($url . "user.xml");

$element = $dom->getElementsByTagName("users");

$dataArray = array();

foreach ($element as $nodes) {
	
    foreach ($nodes->childNodes as $node) {

    	foreach ($node->childNodes as $item) {

	        if ($item->nodeName == "ip") {

	        	$dataArray[$item->nodeName] = $item->nodeValue;
	        }
	        if ($item->nodeName == "nav") {
	        	
	       		$dataArray[$item->nodeName] = $item->nodeValue;
	        } 
	        if ($item->nodeName == "time") {

	       		$dataArray[$item->nodeName] = $item->nodeValue;
	        }

	    }

	   array_push($datasArray,$dataArray);

    }	
}

?>
