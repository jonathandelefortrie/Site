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
	    else if(a === undefined || a == null || a === "" || a === "Your email is not filled !"){
	    	email.removeClass("correct");
	    	email.addClass("error");
	    	email.val("Your email is not filled !");
			return false;
	    }
	    else{
			email.removeClass("correct");
			email.addClass("error");
			email.val("Your email is invalid !");
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
	    else if(b === undefined || b == null || b === "" || b === "Your lastname is not specified !"){
	     	familyname.removeClass("correct");
			familyname.addClass("error");
	    	familyname.val("Your lastname is not specified !");
			return false;
	    }
		else{
			familyname.removeClass("correct");
			familyname.addClass("error");
			familyname.val("Your lastname is invalid !");
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
	    else if(c === undefined || c == null || c === "" || c === "Your firstname is not specified !"){
	     	firstname.removeClass("correct");
			firstname.addClass("error");
	    	firstname.val("Your firstname is not specified !");
			return false;
	    }
		else{
			firstname.removeClass("correct");
			firstname.addClass("error");
			firstname.val("Your firstname is invalid !");
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
	    else if(d === undefined || d == null || d === "" || d === "Provided the object of your email !"){
	     	subject.removeClass("correct");
			subject.addClass("error");
	    	subject.val("Provided the object of your email !");
			return false;
	    }
		else{
			subject.removeClass("correct");
			subject.addClass("error");
			subject.val("The object of your email is invalid !");
			return false;
		}
	}

	function validateMessage(){

		var message = $("#message");
		var e = message.val();

		if(e.length < 10 && e.length > 0){

			message.removeClass("text-correct");
			message.addClass("error");
			message.val("Your message is too short ...");

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
			message.val("You must send a message to be sure to get a concrete answer ...");

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