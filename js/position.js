function doPosition(){
    if(mode == "site"){
      site.style.left = 0 + 'px';
      game.style.left = width + 'px';
    }
    if(mode == "game"){
      site.style.left = -width + 'px';
      game.style.left = 0 + 'px';
    }
}

function slide(dx,px,div){
 
  vx = (dx - px) / 10;
  px += Math.round(vx);
      
  div.style.left = px + 'px';
  set = setTimeout(function(){slide(dx,px,div);},35);
  
  if(dx+5==px) clearTimeout(set);
  else if(dx-5==px) clearTimeout(set);
}
