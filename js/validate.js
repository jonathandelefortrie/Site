$('#form-mail input').live('click',function(){

	if($(this).attr('id') != "send") {
		$(this).val("");
		$(this).removeClass("error");
		$(this).addClass("correct");
	}
});


$('#form-mail').live('submit',function(){
	
	if(validateEmail() & validateFamilyname() & validateFirstname() & validateSubject() & validateMessage()) return true;
	else return false;

	function validateEmail(){

		var email = $("#email");
		var a = email.val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			
		if(filter.test(a)){
			email.removeClass("error");
			email.addClass("correct");
	      	return true;
	    }
	    else if(a === undefined || a == null || a === "" || a === "Votre email n'est pas renseigné !"){
	    	email.removeClass("correct");
	    	email.addClass("error");
	    	email.val("Votre email n'est pas renseigné !");
			return false;
	    }
	    else{
			email.removeClass("correct");
			email.addClass("error");
			email.val("Votre mail est invalide !");
			return false;
		}
	}

	function validateFamilyname(){

		var familyname = $("#familyname");
		var b = familyname.val();
		var filter = /^[A-Za-z \-çñàáâãäêèéêëòóôõöùúûüìíîïýÿÄÃÁÊÌÍÎÏÒÓÔÕÖÙÚÛÜÝŸ]{1,45}$/;
			
		if(filter.test(b)){
			familyname.removeClass("error");
			familyname.addClass("correct");
	        return true;
	    }
	    else if(b === undefined || b == null || b === "" || b === "Votre nom n'est pas renseigné !"){
	     	familyname.removeClass("correct");
			familyname.addClass("error");
	    	familyname.val("Votre nom n'est pas renseigné !");
			return false;
	    }
		else{
			familyname.removeClass("correct");
			familyname.addClass("error");
			familyname.val("Votre nom est invalide !");
			return false;
		}
	}

	function validateFirstname(){

		var firstname = $("#firstname");
		var c = firstname.val();
		var filter = /^[A-Za-z \-çñàáâãäêèéêëòóôõöùúûüìíîïýÿÄÃÁÊÌÍÎÏÒÓÔÕÖÙÚÛÜÝŸ]{1,45}$/;
			
		if(filter.test(c)){
			firstname.removeClass("error");
			firstname.addClass("correct");
	        return true;
	    }
	    else if(c === undefined || c == null || c === "" || c === "Votre prénom n'est pas renseigné !"){
	     	firstname.removeClass("correct");
			firstname.addClass("error");
	    	firstname.val("Votre prénom n'est pas renseigné !");
			return false;
	    }
		else{
			firstname.removeClass("correct");
			firstname.addClass("error");
			firstname.val("Votre prénom est invalide !");
			return false;
		}
	}

	function validateSubject(){

		var subject = $("#subject");
		var d = subject.val();
		var filter = /^[A-Za-z \-çñàáâãäêèéêëòóôõöùúûüìíîïýÿÄÃÁÊÌÍÎÏÒÓÔÕÖÙÚÛÜÝŸ]{1,45}$/;
			
		if(filter.test(d)){
			subject.removeClass("error");
			subject.addClass("correct");
	        return true;
	    }
	    else if(d === undefined || d == null || d === "" || d === "Renseigné l'object de votre email !"){
	     	subject.removeClass("correct");
			subject.addClass("error");
	    	subject.val("Renseigné l'object de votre email !");
			return false;
	    }
		else{
			subject.removeClass("correct");
			subject.addClass("error");
			subject.val("L'object de votre email est invalide !");
			return false;
		}
	}

	function validateMessage(){

		var message = $("#message");
		var e = message.val();

		if(e.length < 10 && e.length > 0){

			message.removeClass("text-correct");
			message.addClass("error");
			message.val("Votre message est trop court ...");

			message.delay(3500).queue(function(){
				message.val("");
				message.removeClass("error");
				message.addClass("text-correct");
				message.dequeue();
			});

			return false;
		}
		else if(e === undefined || e == null || e === ""){

			message.removeClass("text-correct");
			message.addClass("error");
			message.val("Vous devez adresser un message pour être sur d'obtenir une reponse concrète ...");

			message.delay(3500).queue(function(){
				message.val("");
				message.removeClass("error");
				message.addClass("text-correct");
				message.dequeue();
			});

			return false;
		}
		else{			
			return true;
		}
	}
});