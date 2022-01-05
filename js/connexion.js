var pseudo_ok = 0;
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
/*on vérifie si le mdp est correct*/
document.getElementById('password').oninput= function(){
    if(this.checkValidity()){
	pass_ok = 1;
    }
    else{
	pass_ok = 0;
    }
}

/*on active le bouton de soumission*/
document.getElementById('form').oninput = function(){
    console.log(pseudo_ok+' '+pass_ok);
    if(pseudo_ok && pass_ok){
	document.getElementById('bouton_invalid').style.display = "none";
	document.getElementById('bouton_valid').style.display = "inline-block";
    }
    else{
	document.getElementById('bouton_invalid').style.display = "inline-block";
	document.getElementById('bouton_valid').style.display = "none";
    }
}

/*on envoie le formulaire et on gère les erreurs*/
document.getElementById('form').addEventListener("submit",function(e){
    e.preventDefault();
    var data = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
	    console.log(this.response);
	    if(this.response[0] == 0){
		document.getElementById('pseudo_error').style.display = "inline";
	    }
	    else{
		document.getElementById('pseudo_error').style.display = "none";
	    }
	    if(this.response[1] == 0){
		document.getElementById('pass_error').style.display = "inline";
	    }
	    else{
		document.getElementById('pass_error').style.display = "none";
	    }
	    if(this.response == 11){
		document.location.href= "https://mira2.univ-st-etienne.fr/~rg06871s/projet/";
	    }
	}
	else if(this.readyState == 4){
	    console.log('Erreur');
	}
    };
    xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/connexion.inc.php",true);
    xhr.send(data);
    return false;
});
