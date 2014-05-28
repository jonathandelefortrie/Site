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

<body>
  <div id="content-game" class="content-game">
    <div class="manuel">
        <p class="img-manuel"></p>
        <p class="title-manuel">online multiplayer game with the node js technology</p>
        <p class=subtitle-manuel>loading ...</p>
    </div>
  </div>
	<div id="content-site" class="content-site">
    	<header class="content-top">
        	<div class="content-logo flip-container">
            	<span class="logo flipper">
                	<a href="/" border="no" alt="dukegraphinc" title="dukegraphinc">
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
                    <li><a onclick="number=1; hauteur=420; lien='logotype'; onLoad('php/portfolios/portfolios.php', 'content-load');">Logo</a></li>
                    <li><a onclick="number=1; hauteur=420; lien='print'; onLoad('php/portfolios/portfolios.php', 'content-load');">Print</a></li>
                    <li><a onclick="number=1; hauteur=470; lien='jeux'; onLoad('php/portfolios/portfolios.php', 'content-load');">Game</a></li>
                    <li><a onclick="number=1; hauteur=470; lien='website'; onLoad('php/portfolios/portfolios.php', 'content-load');">Website</a></li>
                	</ul>
                </div>
                <span class="button"><a onclick="inLoad('php/acquis/acquis.php', 'content-load');">ACQUIRED</a></span>
                <span class="button"><a onclick="inLoad('php/parcours/parcours.php', 'content-load');">CAREER</a></span>
                <!--<span class="button"><a href="php/pdf/cv.pdf" target="self" alt="cv" title="cv">PDF</a></span>-->
                <span class="button"><a onclick="inLoad('php/contact/contact.php', 'content-load');">CONTACT</a></span>
                <span class="line"></span>
                <span class="button-last button-game"><a>LET'S PLAY LIVE WITH ME ...</a></span>
          </nav>
    	</aside>
      <section class="content-center"><div id="content-load" class="content-load"></div></section>
    	<footer class="content-bottom">
        <ul>
          <li><a href="http://www.linkedin.com/in/jonathandelefortrie/en" target="_blank"><img src="src/svg/linkedin.svg"></a></li>
          <li><a href="https://github.com/jonathandelefortrie" target="_blank"><img src="src/svg/github.svg"></a></li>
          <li><a href="skype:nathandelefortrie?call"><img src="src/svg/skype.svg"></a></li>
        </ul>
      </footer>
    </div>
    <script type="text/javascript" charset="utf-8" src="js/validate.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/animate.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/resize.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/load.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/zoom.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/main.js"></script>
</body>
</html>
