var pseudo_ok = 0;
var mail_ok = 0;
var pass_ok = 0;

/*on vérifie si le l'input pseudo est correct*/
document.getElementById('pseudo').oninput = function(){
    if(this.checkValidity()){
	pseudo_ok = 1;
    }
    else{
	pseudo_ok = 0;
    }
}

/*on vérifie si le l'input email est correct*/
document.getElementById('email').oninput = function(){
    if(this.checkValidity()){
	mail_ok = 1;
    }
    else{
	mail_ok = 0;
    }
}

/*on vérifie si les mdp sont corrects*/
function checkPass(e){
    if(e.checkValidity()){
	return 1;
    }
    else{
	return false;
    }
}

/*on vérifie si les mdp sont corrects et correspondent*/
document.getElementById('password').oninput = function(){
    var confirm = document.getElementById('password_confirm');
    if(confirm && checkPass(this) && checkPass(confirm)){
	if(this.value == confirm.value){
	    pass_ok = 1; 
	}
	else{
	    pass_ok = 0;
	}
    }
}

document.getElementById('password_confirm').oninput = function(){
    var pass = document.getElementById('password');
    if(pass && checkPass(this) && checkPass(pass)){
	if(this.value == pass.value){
	    pass_ok = 1; 
	}
	else{
	    pass_ok = 0;
	}
    }
}


/*on active le bouton de soumission*/
document.getElementById('form').oninput = function(){
    if(pseudo_ok && mail_ok && pass_ok){
	document.getElementById('bouton_invalid').style.display = "none";
	document.getElementById('bouton_valid').style.display = "inline-block";
    }
    else{
	document.getElementById('bouton_invalid').style.display = "inline-block";
	document.getElementById('bouton_valid').style.display = "none";
    }
}

/*on envoie le formulaire et on gére les erreurs*/
document.getElementById('form').addEventListener("submit",function(e){
    e.preventDefault();
    var data = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
	    if(this.response[0] == 0){
		document.getElementById('pseudo_error').style.display = "inline";
	    }
	    else{
		document.getElementById('pseudo_error').style.display = "none";
	    }
	    if(this.response[1] == 0){
		document.getElementById('email_error').style.display = "inline";
	    }
	    else{
		document.getElementById('email_error').style.display = "none";
	    }
	    if(this.response[2] == 0){
		alert("Oups! Il y eu un problème avec les mots de passe...");
	    }
	    if(this.response[3] == 0){
		alert("Il y a un problème à l'inscription...");
	    }
	    else if(this.response[3] == 1){
		document.location.href= "https://mira2.univ-st-etienne.fr/~rg06871s/projet/";
	    }
	    console.log(this.response);
	}
	else if(this.readyState == 4){
	    console.log('Erreur');
	}
    };
    xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/inscription.inc.php",true);
    xhr.send(data);
    return false;
});
