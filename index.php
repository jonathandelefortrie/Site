<?php
  require_once 'log/log.php';
?>

<!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8">

<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache, must-revalidate" />

<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<meta name="robots" content="all" />
<meta name="expires" content="never" />
<meta name="title" content="Dukegraphinc" />
<meta name="document-type" content="Public" />
<meta name="revisit-after" content="7 days" />
<meta name="referrer" content="default" id="meta_referrer" />
<meta name="identifier-url" content="http://www.dukegraphinc.com" />
<meta name="keywords" content="Jonathan, Delefortrie, Webdesigner, Webdeveloper" />
<meta name="news_keywords" content="Jonathan, Delefortrie, Webdesigner, Webdeveloper" />
<meta name="description" content="Bienvenue..." />

<link rel="stylesheet" href="css/layout-home.css" type="text/css" />
<link rel="stylesheet" href="css/layout-mobile.css" type="text/css" />
<link rel="stylesheet" href="css/layout-colorbox.css" type="text/css" />
<link rel="icon" href="src/icon.png" sizes="32x32" type="image/png" />

<script src="js/jquery.min.js"></script>
<script src="js/jquery.svg.js"></script>
<script src="js/jquery.popup.js"></script>
<script src="js/jquery.colorbox.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35698176-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<title>dukegraphinc</title>
</head>

<body><h1 class="title">Bienvenue...</h1>
	<div id="content-site" class="content-site">
    	<header class="content-top">
        	<div class="content-logo">
            	<span class="logo">
                	<a href="" border="no" alt="dukegraphinc" title="dukegraphinc">
                      <svg version="1.2" baseProfile="tiny"
                           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                           x="0px" y="0px" width="72px" height="54px" viewBox="0 0 236 179" xml:space="preserve">
                      <defs>
                      </defs>
                      <path fill="#1D1D1D" d="M113.8,178.5H63C7,178.5,0,142,0,89.3C0,36.5,7,0,63,0h50.8V178.5z M85.3,21.5H61.8
                          C37,21.5,28.5,39,28.5,89.3c0,52.3,9.8,67.8,33.3,67.8h23.5V21.5z"/>
                      <path fill="#1D1D1D" d="M151.2,21.5h23.5c24.8,0,33.3,17.5,33.3,67.8c0,1.2,0,2.3,0,3.4l27.8-27.8C232.9,25.6,220.4,0,173.5,0h-50.8
                          v177.9l28.5-28.5V21.5z"/>
                      <path fill="#32859E" d="M207.6,106.4c-2.1,38.6-12.1,50.6-32.8,50.6H157l-21.5,21.5h38c56,0,63-36.5,63-89.3c0-4,0-7.9-0.1-11.6
                          L207.6,106.4z"/>
                      </svg>
                	</a>
              </span>
          </div>
          <div class="content-name">
            
            	<span id="name" class="name" onmouseover="fisheye(event); boolean=true;" onmouseout="boolean=false;">
                    <h1>d</h1>
                    <h1>u</h1>
                    <h1>k</h1>
                    <h1>e</h1>
                    <h1>g</h1>
                    <h1>r</h1>
                    <h1>a</h1>
                    <h1>p</h1>
                    <h1>h</h1>
                    <h1>i</h1>
                    <h1>n</h1>
                    <h1>c</h1>
                    <font class="text">&nbsp;©</font>
              </span>
            
          </div>
      </header>
    	<aside class="content-left">
          <nav class="content-button">
            	<span id="button" class="button"><a>PORTFOLIOS</a></span>
                <div class="under-button">
                	<ul>
                        <li><a onclick="number=1; hauteur=470; lien='jeux'; onLoad('php/portfolios/portfolios.php', 'content-load');">Jeux</a></li>
                        <li><a onclick="number=1; hauteur=420; lien='print'; onLoad('php/portfolios/portfolios.php', 'content-load');">Print</a></li>
                        <li><a onclick="number=1; hauteur=470; lien='website'; onLoad('php/portfolios/portfolios.php', 'content-load');">Website</a></li>
                        <li><a onclick="number=1; hauteur=420; lien='logotype'; onLoad('php/portfolios/portfolios.php', 'content-load');">Logotype</a></li>
                	</ul>
                </div>
                <span class="button"><a onclick="inLoad('php/parcours/parcours.php', 'content-load');">PARCOURS</a></span>
                <span class="button"><a onclick="inLoad('php/acquis/acquis.php', 'content-load');">ACQUIS</a></span>
                <span class="button"><a href="php/pdf/cv.pdf" target="self" alt="cv" title="cv">PDF</a></span>
                <span class="button"><a onclick="inLoad('php/contact/contact.php', 'content-load');">CONTACT</a></span>
                <span class="line"></span>
                <span class="button-last"><a href="">QUEL SERA MON FUTUR ...</a></span>
          </nav>
    	</aside>
      <section class="content-center">
            <div id="content-load" class="content-load"></div>
            <div id="content-time" class="content-time"></div>
    	</section>
    	<footer class="content-bottom">
    	     <div id="button-game" class="button-game">
              <svg version="1.2" baseProfile="tiny"
              	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
              	 x="0px" y="0px" width="53px" height="35px" viewBox="-1.998 -1.296 53 35" xml:space="preserve">
              <defs>
              </defs>
              <path fill="#32859E" d="M0.106,0.019c0,7.338,8.695,13.33,19.498,13.33l2.62-0.012h12.992V5.511L49.44,17.925H22.223l-2.374,0.006
              	C9.047,17.931,0.106,9.92,0.106,0"/>
              <path fill="#32859E" d="M0,4.145C0.898,12.566,9.726,19.67,19.604,19.67l1.694-0.012l0.925,0.001H49.44L35.215,32.073v-7.826H22.223
              	l-0.925-0.001l-1.044,0.004C10.377,24.25,0,14.064,0,4.145"/>
              </svg>
           </div>
      </footer>
    </div>
    <div id="content-game" class="content-game">
      <div id="game" class="game"></div>
      <div id="button-site" class="button-site">
          <svg version="1.2" baseProfile="tiny"
          	 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
          	 x="0px" y="0px" width="53px" height="35px" viewBox="-1.998 -1.296 53 35" xml:space="preserve">
          <defs>
          </defs>
          <path fill="#32859E" d="M49.334,32.055c0-7.338-8.695-13.33-19.498-13.33l-2.62,0.012H14.226v7.826L0,14.148h27.217l2.374-0.006
          	c10.802,0,19.743,8.011,19.743,17.931"/>
          <path fill="#32859E" d="M49.44,27.929c-0.898-8.422-9.726-15.525-19.604-15.525l-1.694,0.012l-0.925-0.001H0L14.226,0v7.826h12.992
          	l0.925,0.001l1.044-0.004C39.063,7.823,49.44,18.009,49.44,27.929"/>
          </svg>
      </div>
      <div class="manuel">
        <p class="img-manuel"></p>
        <p class="title-manuel">online multiplayer game with the node js technology</p>
        <p class=subtitle-manuel>invite your friends to play with you</p>
      </div>
    </div>
<script type="text/javascript" charset="utf-8" src="js/position.js"></script>
<script type="text/javascript" charset="utf-8" src="js/validate.js"></script>
<script type="text/javascript" charset="utf-8" src="js/animate.js"></script>
<script type="text/javascript" charset="utf-8" src="js/counter.js"></script>
<script type="text/javascript" charset="utf-8" src="js/resize.js"></script>
<script type="text/javascript" charset="utf-8" src="js/load.js"></script>
<script type="text/javascript" charset="utf-8" src="js/zoom.js"></script>
<script type="text/javascript" charset="utf-8" src="js/main.js"></script>
<script type="text/javascript"> 
  $(document).ready(function(){
  		pageReady();
  });
</script>
</body>
</html>
