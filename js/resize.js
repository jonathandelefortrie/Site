function doResize(){
	if($.browser.msie){
		if(width >= limite) {
        	margin = ( ($('.img-line').width() - $('.img').width()) / 2 );
        	$('.img').css("margin-left", margin);
        	$('.content-center').width($(window).width() - $('.content-left').width() - 65);
        	$('.content-time').css("margin-left", ($('.content-center').width() - 280)/2);
    	}
		if(width <= limite) {
        	margin = ( ($('.content-img').width() - $('.img img').width()) / 2 );
		    $('.img').css("margin-left", margin);
        	$('.content-center').css("width", "auto");
    	}

    	button = ($('.content-img-line').width() - ($('.img-line').width() + $('.content-point').width() + 62)) / 2;
		$('.content-point').css("margin-left", button);
		
		manuel = ($('.content-game').height() - $('.manuel').height()) / 2;
		$('.manuel').css("margin-top", manuel);
		
		doAnimate();
	}
	else if($.browser.mozilla){
		if(width >= limite) {
		    margin = ( ($('.img-line').width() - $('.img').width()) / 2 );
		    $('.img').css("margin-left", margin);
	        $('.content-center').width(width - $('.content-left').width()- 65);
	        $('.content-time').css("margin-left", ($('.content-center').width() - 280)/2);
	    }
		if(width <= limite) {
		    margin = ( ($('.content-img').width() - $('.img img').width()) / 2 );
		    $('.img').css("margin-left", margin);
        	$('.content-center').css("width", "auto");
    	}

    	button = ($('.content-img-line').width() - ($('.img-line').width() + $('.content-point').width() + 62)) / 2;
		$('.content-point').css("margin-left", button);
		
		manuel = ($('.content-game').height() - $('.manuel').height()) / 2;
		$('.manuel').css("margin-top", manuel);
		
		doAnimate();
	}
	else if($.browser.chrome){
		if(width >= limite) {
		    margin = ( ($('.img-line').width() - $('.img').width()) / 2 );
		    $('.button-last').css("width", 90);
        	$('.content-center').width(width - $('.content-left').width() - 65);
  		  	$('.img').css("margin-left", margin);
        	$('.line').css("width", 90);
        	$('.content-button').css("width", "100%");
        	$('.under-button').css("margin-left", 25);
        	$('.content-time').css("margin-left", ($('.content-center').width() - 280)/2);
    	}
		if(width <= limite) {
  		  	margin = ( ($('.content-img').width() - $('.img img').width()) / 2 );
		    $('.img').css("margin-left", margin);
  		  	$('.content-center').css("width", "auto");
  		  	$('.line').css("width", "100%");
        	$('.content-button').css("width", 256);
        	$('.under-button').css("margin-left", 20);
    	}

    	button = ($('.content-img-line').width() - ($('.img-line').width() + $('.content-point').width() + 62)) / 2;
		$('.content-point').css("margin-left", button);
		
		manuel = ($('.content-game').height() - $('.manuel').height()) / 2;
		$('.manuel').css("margin-top", manuel);
		
		doAnimate();
	}
	else if($.browser.safari){
		if(width >= limite) {
    		margin = ( ($('.img-line').width() - $('.img').width()) / 2 );
    		$('.button-last').css("width", 90);
        	$('.content-center').width(width - $('.content-left').width() - 65);
  		  	$('.img').css("margin-left", margin);
        	$('.line').css("width", 90);
        	$('.content-button').css("width", "100%");
        	$('.under-button').css("margin-left", 25);
        	$('.content-time').css("margin-left", ($('.content-center').width() - 280)/2);
    	}
		if(width <= limite) {
  		  	margin = ( ($('.content-img').width() - $('.img img').width()) / 2 );
		    $('.img').css("margin-left", margin);
  		  	$('.content-center').css("width", "auto");
  		  	$('.line').css("width", "100%");
        	$('.content-button').css("width", 256);
        	$('.under-button').css("margin-left", 20);
    	}

    	button = ($('.content-img-line').width() - ($('.img-line').width() + $('.content-point').width() + 62)) / 2;
		$('.content-point').css("margin-left", button);
		
		manuel = ($('.content-game').height() - $('.manuel').height()) / 2;
		$('.manuel').css("margin-top", manuel);
		
		doAnimate();
	}
	else if($.browser.opera){
		if(width >= limite) {
		    margin = ( ($('.img-line').width() - $('.img').width()) / 2 );
		    $('.button-last').css("width", 90);
        	$('.content-center').width(width - $('.content-left').width() - 65);
  		  	$('.img').css("margin-left", margin);
        	$('.line').css("width", 90);
        	$('.content-button').css("width", "100%");
        	$('.under-button').css("margin-left", 25);
        	$('.content-time').css("margin-left", ($('.content-center').width() - 280)/2);
    	}
		if(width <= limite) {
  		  	margin = ( ($('.content-img').width() - $('.img img').width()) / 2 );
		    $('.img').css("margin-left", margin);
  		  	$('.content-center').css("width", "auto");
  		  	$('.line').css("width", "100%");
        	$('.content-button').css("width", 255);
        	$('.under-button').css("margin-left", 20);
    	}
    	
    	button = ($('.content-img-line').width() - ($('.img-line').width() + $('.content-point').width() + 62)) / 2;
		$('.content-point').css("margin-left", button);
		
		manuel = ($('.content-game').height() - $('.manuel').height()) / 2;
		$('.manuel').css("margin-top", manuel);
		
		doAnimate();
	}
}
