function origin(ArrayLetter){

	if(!boolean) {

		for(var u=0 ; u<ArrayLetter.length ; u++)
		{
		ArrayLetter[u].style.fontSize=sizeMin+"px";
	    }
	}
}

function fisheye(event) {

		var x = 0;

		if (document.all) x = event.clientX ;
		else x = event.pageX ;
			
		x -= contener.offsetLeft ;
		
		ArrayLetter = new Array();
		ArrayLetter = contener.getElementsByTagName('h1');

		for(var i=0 ; i<ArrayLetter.length ; i++)
		{
			midle = ArrayLetter[i].offsetLeft + (ArrayLetter[i].offsetWidth / 2);
			delta = midle - x;

			if (delta < 0) delta *= -1;

			coef = a * delta + sizeMax;

			if (coef < sizeMin) coef = sizeMin;
			else if (coef > sizeMax) coef = sizeMax;

			ArrayLetter[i].style.fontSize=coef+"px";
			ArrayLetter[i].style.fontSize=coef+"px";
		}
	
	setTimeout(function(){origin(ArrayLetter);},50);
}
