function onLoad(location,target){
	
	if (number>maxi)number = mini;
	else if (number<mini)number = maxi;
	
	if (width>=limite) taille = hauteur;
	else if (width<=limite) taille = 0;

	$.ajax({
	    type: "GET",
	    async: false,
	    data: "id="+number+"&name="+lien,
	    url: location,
	    success: function(result)
	    {
	   		$("#"+target).html(result);
	   		$("#"+number).css("background-color","#32859e");
  			$(".content-img").css("min-height", taille);
  			$(".point").delay(500).fadeTo(1000, 100);
  			$(".img").delay(500).fadeTo(1000, 100);
  			$(".lightbox").colorbox({rel:'lightbox'});
  			$(".lien_c").popupWindow({
  				height:650,
  				width:900,
  				centerBrowser:1
  			});
  			$(".lien_b").popupWindow({
  				height:450,
  				width:450,
  				centerBrowser:1
  			});
  			$(".lien_a").popupWindow({
  				height:750,
  				width:1150,
  				centerBrowser:1
  			});
  			setTimeout(function(){doResize();},500);
  	  },
	   	error: function()  
      {  
          alert("Erreur de chargement");
      } 
	});
}

function inLoad(page,target){

	$("#"+target).load(page);
}

function upLoad(location,target){
	
	var Name = $("#name").attr("value");
	var Firstname = $("#firstname").attr("value");
	var Email = $("#email").attr("value");
	var Subject = $("#subject").attr("value");
	var Message = $("#message").attr("value");
	
	var request = $.ajax({
		type: "POST",
	  	url: location,
	  	data: { name: Name, firstname: Firstname, email: Email, subject: Subject, message: Message},
	  	dataType: "html",
	  	async: false,
		success: function(result){ $("#"+target).html(result);}
	});
}
