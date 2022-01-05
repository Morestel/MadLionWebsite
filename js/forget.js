var pseudo_ok = 0;
var pass_ok = 0;

/*on vérifie si le l'input pseudo est correct et on permet de passer à l'étape suivante*/
document.getElementById('pseudo').oninput = function(){
    if(this.checkValidity()){
	document.getElementById('pseudo_invalid').style.display = "none";
	document.getElementById('pseudo_valid').style.display = "inline-block";
    }
    else{
	document.getElementById('pseudo_invalid').style.display = "inline-block";
	document.getElementById('pseudo_valid').style.display = "none";
    }
}

/*on envoie le formulaire pour vérifier que le pseudo existe*/
document.getElementById('form_pseudo').addEventListener("submit",function(e){
    e.preventDefault();
    var data = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
	    if(this.response == "0"){
		document.getElementById('form_pseudo').style.display = "inline";
		document.getElementById('form_code').style.display = "none";
	    }
	    else{
		document.getElementById('form_pseudo').style.display = "none";
		document.getElementById('form_code').style.display = "inline";
		pseudo_ok = 1;
	    }
	}
	else if(this.readyState == 4){
	    console.log('Erreur');
	}
    };
	
    xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/forget.inc.php",true);
    xhr.send(data);
    return false;
});


/*on bloque la saisie pour n'avoir que des chiffres et si l'input est valide on passe au suivant*/
var checkCode = function(){
    this.value = this.value.replace(/\D*/,"");
    if(this.checkValidity()){
	this.nextElementSibling.focus();
    }
}
document.getElementById('code1').addEventListener("input",checkCode,false);
document.getElementById('code2').addEventListener('input',checkCode,false);
document.getElementById('code3').addEventListener('input',checkCode,false);
document.getElementById('code4').addEventListener('input',checkCode,false);

document.getElementById('form_code').addEventListener("input", function(e){
    var code1 = document.getElementById('code1').checkValidity();
    var code2 = document.getElementById('code2').checkValidity();
    var code3 = document.getElementById('code3').checkValidity();
    var code4 = document.getElementById('code4').checkValidity();
    if(code1 && code2 && code3 && code4){
	document.getElementById('code_invalid').style.display = "none";
	document.getElementById('code_valid').style.display = "inline-block";
    }
    else{
	document.getElementById('code_invalid').style.display = "inline-block";
	document.getElementById('code_valid').style.display = "none";
    }
});
/*on envoie le formulaire du code*/
document.getElementById('form_code').addEventListener("submit",function(e){
    e.preventDefault();
    var data = new FormData(this);
    data.append('pseudo',document.getElementById('pseudo').value);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
	if(this.readyState == 4 && this.status == 200){
	    console.log(this.response);
	    if(this.response == ""){
		document.getElementById('form_pseudo').style.display = "inline";
		document.getElementById('form_code').style.display = "none";
	    }
	    else{
		document.getElementById('form_pseudo').style.display = "none";
		document.getElementById('form_code').style.display = "inline";
		pseudo_ok = 1;
	    }
	}
	else if(this.readyState == 4){
	    console.log('Erreur');
	}
    };
	
    xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/forget.inc.php",true);
    xhr.send(data);
    return false;
});
