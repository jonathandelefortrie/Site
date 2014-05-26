const endoftheworld = "21:12:12:12";

var interval,date,secs,mins,hours,days;

var sec = (+endoftheworld.substring(9, endoftheworld.length));
var min = (+endoftheworld.substring(6, endoftheworld.length-3)) * 60;
var hour = (+endoftheworld.substring(3, endoftheworld.length-6)) * 3600;
var day = (+endoftheworld.substring(0, endoftheworld.length-9)) * 86400;

interval = setInterval(function(){

  date = new Date();
  secs = sec - date.getSeconds();
  mins = min - date.getMinutes() * 60;
  hours = hour - date.getHours() * 3600;
  days = day - date.getDay() * 86400;

  theday = secs + mins + hours + days;

  d = clean(thedayinday = Math.floor(theday / 86400));
  h = clean(thedayinhour = Math.floor((theday % 86400) / 3600));
  m = clean(thedayinmin = Math.floor(((theday % 86400) % 3600) / 60));
  s =clean(thedayinsec = Math.floor(((theday % 86400) % 3600) % 60));

  html =  '<h1>'+d+'</h1><p>:</p><h1>'+h+'</h1><p>:</p><h1>'+m+'</h1><p>:</p><h1>'+s+'</h1>';

  window.document.getElementById( 'content-time' ).innerHTML = html;

},1000);


function clean(number) {

    string = number.toString();

    if(string.length < 2) return "0" + string;
    else return string;
}
