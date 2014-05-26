function pageReady(){
  mode = "site";

  doPosition();
  doResize();
}

var c,r;

var limite = 1024;
var largeur = 0;

var mini = 1;
var maxi = "";
var lien = "";
var number = 1;

var total = 9;
var text = "";
var title = "";
var new_x = new Array;
var new_y = new Array;

var sizeMin = 28;
var sizeMax = 46;

var effect = 1.2;
var a = ((sizeMin-sizeMax)/(sizeMax * effect));
var contener = document.getElementById('name');

var width = $(window).width();
var height = $(window).height();

var site = window.document.getElementById('content-site');
var game = window.document.getElementById('content-game');

var iframe = '<iframe seamless="seamless" id="game" name="game" src="http://jonathandelefortrie-game.jit.su/"></iframe>';

$("#button").click(function () {
	if ($(".under-button").is(":hidden")) $(".under-button").slideDown("slow");
	else if ($(".under-button").is(":visible")) $(".under-button").slideUp("slow");
});

$("#button-game").click(function () {
    mode = "game";
    slide(-width-5,site.offsetLeft,site);
    slide(0-5,game.offsetLeft,game);
    $('body').css('overflow-y','hidden');
    c = setTimeout(function(){$("#game").append(iframe);},4000);
});

$("#button-site").click(function () {
    mode = "site";
    slide(0+5,site.offsetLeft,site);
    slide(width+5,game.offsetLeft,game);
    $("#game").empty();
    $('body').css('overflow-y','visible');
    clearTimeout(c);
});

$(window).resize(function(){
  width = window.innerWidth;
  height = window.innerHeight;
	r = setTimeout(function(){
	  doPosition();
    doResize();
    clearTimeout(r);
  },50);
});
