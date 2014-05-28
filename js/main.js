var c,r;

var limite = 1024;
var largeur = 0;

var mini = 1;
var maxi = "";
var lien = "";
var number = 1;

var total = 10;
var text = "";
var title = "";
var new_x = new Array;
var new_y = new Array;

var sizeMin = 28;
var sizeMax = 46;

var effect = 1.2;
var width, height;
var a = ((sizeMin-sizeMax)/(sizeMax * effect));
var contener = document.getElementById('name');

var site = window.document.getElementById('content-site');
var game = window.document.getElementById('content-game');

var iframe = '<iframe seamless="seamless" id="game" style="opacity:0;" name="game" onload="displayGame();" src="http://jonathandelefortrie-game.jit.su/"></iframe>';

var displayGame = function() {
  $(".manuel").hide();
  $("#game").fadeTo(500,1);
  $("body").css("cursor","auto");
}

$("#button").click(function () {
	if ($(".under-button").is(":hidden")) $(".under-button").slideDown("slow");
	else if ($(".under-button").is(":visible")) $(".under-button").slideUp("slow");
});

$(".button").click(function(){
  if ($(".button-game").hasClass("back-game"))
  {
    $(".manuel").hide();
    $("#game").remove();
    $(".content-bottom").show();
    $("body").css("cursor","auto");
    $(".button-game").removeClass("back-game");
  }
});

$(".button-game").click(function () {
  if(!$(this).hasClass("back-game"))
  {
    $(".manuel").fadeIn();
    $(".content-bottom").hide();
    $("#content-load").empty();
    $("#content-game").append(iframe).height(height);
    $(this).addClass("back-game");
    $('body').css("cursor","wait");
    $(window).trigger("resize");
  }
});

$(document).ready(function(){
  width = window.innerWidth;
  height = window.innerHeight;
  doResize();
});

$(window).resize(function(){
  width = window.innerWidth;
  height = window.innerHeight;
  doResize();
  if($("#content-game").children("iframe").length > 0) $("#content-game").height(height);
});