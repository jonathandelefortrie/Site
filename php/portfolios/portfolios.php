<?php
header("Content-Type: text/plain; charset=UTF-8");

$finder = $_GET['name'];
$source = $finder . ".xml";
$chemin = "src/" . $finder . "/";
$number = $_GET['id'];
$nameTotal = "total";
$extension = ".jpg";
$text = "";
$lien = "";
$href = "";

$dom = new DomDocument();
$dom->preserveWhiteSpace = false;
$dom->load($source);

$element = $dom->getElementsByTagName("file");

foreach ($element as $nodes) {
 
  $Attributes = $nodes->attributes;
				
  foreach ($Attributes as $attrNode) {
  	
	$name = $attrNode->nodeName;
	$num = $attrNode->value;
	
	if($name == $nameTotal){
	  $numTotal = $attrNode->value;
  	}		
  }
  if($num == $number) {
     
    foreach ($nodes->childNodes  as $node) {
  
        if ($node->nodeName == "url") $url = $node->firstChild->data;
		    if ($node->nodeName == "href") $href = $node->firstChild->data;
		    if ($node->nodeName == "lien") $lien = $node->firstChild->data;
        if ($node->nodeName == "titre") $titre = $node->firstChild->data;
        if ($node->nodeName == "description") $description = $node->firstChild->data;   	
      }
   }	
}
if($href == "") $href = "lien";
if($lien != "") $text = "&nbsp;&nbsp;click here";
$numMaxi = $numTotal - 1;
$div = Array();
for($i = 1 ; $i < $numTotal; $i++) {
			
	  $div [] = '<div id="' . $i . '" class="point"></div>';   
}
function create_url($chemin, $lien){
    if(substr($lien, 0, 4) == "http") $newUrl = $lien;
    else $newUrl = $chemin . $lien;
    return $newUrl;
}
?>	
<span id="content-img" class="content-img"><span class="img"><a class="lightbox" href="<?php echo $chemin . $url . "_max" . $extension; ?>"><img src="<?php echo $chemin . $url . $extension; ?>" style="border:1px solid #d2d2d1;" border="no" onload="setTimeout(function(){doResize();},50);" /></a></span></span>
<span class="content-img-line">
	<span class="img-line"></span>
    <span id="left" class="img-left"><a onclick="maxi=<?php echo $numMaxi; ?>; number--; onLoad('php/portfolios/portfolios.php', 'content-load');">
    	<svg version="1.2" baseProfile="tiny"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                 x="0px" y="0px" width="29px" height="15px" viewBox="0 0 239 116" xml:space="preserve">
            <defs>
            </defs>
            <path d="M219.446,0c0.773,0,1.542,0.298,2.122,0.879l15.807,15.807c0.625,0.624,0.942,1.491,0.868,2.37
                c-0.073,0.88-0.529,1.683-1.249,2.194l-50.829,36.202l51.574,36.868c0.718,0.513,1.174,1.314,1.246,2.193s-0.246,1.745-0.869,2.368
                l-15.841,15.841c-0.581,0.581-1.349,0.879-2.122,0.879c-0.607,0-1.219-0.185-1.744-0.56l-77.154-55.154
                c-0.788-0.563-1.256-1.474-1.255-2.443c0.001-0.969,0.47-1.878,1.26-2.44l76.447-54.447C218.231,0.183,218.841,0,219.446,0z"/>
            <polygon points="143,57.447 220.154,112.602 235.995,96.761 181,57.447 235.254,18.807 219.447,3 "/>
            <path d="M149.446,0c0.773,0,1.542,0.298,2.122,0.879l15.807,15.807c0.625,0.624,0.941,1.491,0.869,2.37
                c-0.074,0.88-0.531,1.683-1.25,2.194l-50.829,36.202L167.74,94.32c0.717,0.513,1.172,1.314,1.244,2.193
                c0.073,0.879-0.244,1.745-0.868,2.368l-15.841,15.841c-0.58,0.581-1.349,0.879-2.122,0.879c-0.608,0-1.218-0.185-1.743-0.56
                L71.255,59.888c-0.788-0.563-1.256-1.474-1.255-2.443c0.001-0.969,0.47-1.878,1.26-2.44l76.447-54.447
                C148.23,0.183,148.84,0,149.446,0z"/>
            <polygon points="73,57.447 150.154,112.602 165.995,96.761 111,57.447 165.254,18.807 149.447,3 "/>
            <path d="M79.446,0c0.773,0,1.542,0.298,2.122,0.879l15.807,15.807c0.625,0.624,0.941,1.491,0.869,2.37
                c-0.074,0.88-0.531,1.683-1.25,2.194L46.165,57.452L97.74,94.32c0.717,0.513,1.172,1.314,1.244,2.193
                c0.073,0.879-0.244,1.745-0.868,2.368l-15.841,15.841c-0.58,0.581-1.349,0.879-2.122,0.879c-0.608,0-1.218-0.185-1.743-0.56
                L1.255,59.888C0.467,59.324-0.001,58.414,0,57.444c0.001-0.969,0.47-1.878,1.26-2.44L77.707,0.557C78.23,0.183,78.84,0,79.446,0z"/>
            <polygon points="3,57.447 80.154,112.602 95.995,96.761 41,57.447 95.254,18.807 79.447,3 "/>
    	</svg>
    </a>
    </span>
    <span class="content-point"><?php echo implode($div); ?></span>
    <span id="right" class="img-right"><a onclick="maxi=<?php echo $numMaxi; ?>; number++; onLoad('php/portfolios/portfolios.php', 'content-load');">
    	<svg version="1.2" baseProfile="tiny"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                 x="0px" y="0px" width="29px" height="15px" viewBox="0 0 239 116" xml:space="preserve">
            <defs>
            </defs>
            <path d="M19.549,115.602c-0.773,0-1.542-0.298-2.122-0.879L1.62,98.916c-0.625-0.624-0.942-1.491-0.869-2.37
                c0.074-0.88,0.53-1.683,1.25-2.194L52.83,58.149L1.255,21.281c-0.717-0.513-1.173-1.315-1.245-2.193
                c-0.073-0.879,0.245-1.745,0.869-2.368L16.72,0.879C17.3,0.298,18.068,0,18.842,0c0.608,0,1.218,0.184,1.744,0.56L97.74,55.714
                c0.788,0.563,1.256,1.474,1.255,2.443c-0.001,0.969-0.47,1.878-1.26,2.44l-76.447,54.447
                C20.764,115.419,20.155,115.602,19.549,115.602z"/>
            <polygon points="95.995,58.154 18.841,3 3,18.841 57.995,58.154 3.741,96.795 19.548,112.602 "/>
            <path d="M89.549,115.602c-0.773,0-1.542-0.298-2.122-0.879L71.62,98.916c-0.625-0.624-0.941-1.491-0.869-2.37
                c0.074-0.88,0.531-1.683,1.25-2.194l50.829-36.202L71.255,21.281c-0.717-0.513-1.172-1.315-1.244-2.193
                c-0.073-0.879,0.244-1.745,0.868-2.368L86.72,0.879C87.3,0.298,88.068,0,88.842,0c0.608,0,1.218,0.184,1.743,0.56l77.155,55.154
                c0.788,0.563,1.256,1.474,1.255,2.443c-0.001,0.969-0.47,1.878-1.26,2.44l-76.447,54.447
                C90.765,115.419,90.155,115.602,89.549,115.602z"/>
            <polygon points="165.995,58.154 88.841,3 73,18.841 127.995,58.154 73.741,96.795 89.548,112.602 "/>
            <path d="M159.549,115.602c-0.773,0-1.542-0.298-2.122-0.879L141.62,98.916c-0.625-0.624-0.941-1.491-0.869-2.37
                c0.074-0.88,0.531-1.683,1.25-2.194l50.829-36.202l-51.575-36.868c-0.717-0.513-1.172-1.315-1.244-2.193
                c-0.073-0.879,0.244-1.745,0.868-2.368L156.72,0.879C157.3,0.298,158.068,0,158.842,0c0.608,0,1.218,0.184,1.743,0.56l77.155,55.154
                c0.788,0.563,1.256,1.474,1.255,2.443c-0.001,0.969-0.47,1.878-1.26,2.44l-76.447,54.447
                C160.765,115.419,160.155,115.602,159.549,115.602z"/>
            <polygon points="235.995,58.154 158.841,3 143,18.841 197.995,58.154 143.741,96.795 159.548,112.602 "/>
        </svg>
    </a>
    </span>
</span>
<span id="img-title" class="img-title"><?php echo $titre; ?></span>
<span id="img-text" class="img-text"><?php echo $description; ?><a target="_blank" href="<?php echo create_url($chemin, $lien); ?>" class="<?php echo $href; ?>"><?php echo $text; ?></a></span>
