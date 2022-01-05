var tab_images = new Array();
var fichier_contenu = new Array();

/*fonction qui permet la mise en forme du texte*/
function miseEnForme(f){
    var titre = document.getElementById('titre_view');
    titre.removeAttribute("contenteditable");
    switch(f){
    case 'gras':
	document.execCommand('bold', false, '');
	break;
    case 'italique':
	document.execCommand('italic', false, '');
	break;
    case 'souligne':
	document.execCommand('underline', false, '');
	break;
    case 'gauche':
	document.execCommand('justifyLeft', false, '');
	break;
    case 'centrer':
	document.execCommand('justifyCenter', false, '');
    break;
    case 'lien':
	var lien = prompt("Lien :");
    document.execCommand("createLink", false, lien);
	break;
    case 'img':
	clicImage();
	break;
    }
    titre.setAttribute("contenteditable","true");
    var box_contenu = document.getElementById('box_contenu');
  box_contenu.focus();
}

/*fonction qui permet d'ouvrir l'input type file pour sélectionner la miniature*/
function clicMiniature(){
    var input = document.getElementById('upload_miniature');
    input.click();
}

/*fonction qui permet de visualiser la miniature*/
function ajoutMiniature(){
  var img_minia = document.getElementById('upload_miniature');
    var box_titre = document.querySelector('.miniature');
    var fichier_minia = new FileReader();
    fichier_minia.onload = function (f){
	var ins_minia = new Image();
	ins_minia.src = f.target.result;
	box_titre.style.backgroundImage= "url('"+ins_minia.src+"')";
  }
    fichier_minia.readAsDataURL(img_minia.files[0]);
}

/*fonction qui permet de recuperer le titre écrit et de le mettre dans le textarea caché*/
function remplirTitre(){
    var element_titre = document.getElementById('titre_view');
    var br = document.getElementById('titre_view').getElementsByTagName('BR');
    var titreUpper = element_titre.innerText.toUpperCase();
    element_titre.addEventListener('keydown',function(e){
	var titre_length = e.target.innerHTML.trim().length;
	if(titre_length > 88 && e.which != 8 && e.which != 46 || e.which == 13){
      e.preventDefault();
	    return false;
	}
    });
    document.getElementById('titre').value = element_titre.innerText;
}

/*fonction qui permet de simuler le clic sur l'input type text*/
function clicImage(){
    var input = document.getElementById('upload_img');
    input.click();
}

/*fonction qui permet d'afficher les images dans l'éditeur*/
function ajoutImages(){
    var img = document.getElementById('upload_img');
    var contenu = document.getElementById('box_contenu');
    var fichier = new FileReader();
  fichier.onload = function (f){
      var ins_img = new Image();
      ins_img.src = f.target.result;
      var div = document.createElement("div");
      contenu.appendChild(div);
      div.appendChild(ins_img);
  }
    fichier_contenu.push(img.files[0]);
    fichier.readAsDataURL(img.files[0]);
    tab_images.push(img.value);
};


/*fonction qui permet de mettre le contenu de l'éditeur dans le textarea caché*/
function remplirContenu(){
    var box_contenu = document.getElementById('box_contenu');
    var img = box_contenu.querySelectorAll("img");
  for(var i = 0; i < img.length; i++){
      img[i].src = "https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/news/"+tab_images[i].replace("C:\\fakepath\\","");
      img[i].setAttribute("alt","Illustration "+tab_images[i].replace("C:\\fakepath\\",""));
  }
    document.getElementById('contenu').value = box_contenu.innerHTML.toString();
}


/*verifie si le formulaire est bien rempli et l'envoi au traitement*/
document.getElementById('form').addEventListener("submit",function(e){
    e.preventDefault();
    
    var data = new FormData(this);
    var img_minia_input = document.getElementById('upload_miniature');
    var img_minia = img_minia_input.files[0];
    data.append('upload_miniature',img_minia);
    for(var i = 0; i < fichier_contenu.length-1; i++){
	data.append('upload_img[]',fichier_contenu[i]);
    }
    var xhr = new XMLHttpRequest();
    
    xhr.onreadystatechange = function(){
	/*
	if(this.readyState == 4 && this.status == 200){
	    console.log(this.response);
	}
	else if(this.readyState == 4){
	    console.log('Erreur');
	    }*///Conditions pour vérifier les  erreurs d'envoi et de traitement côté serveur

	//Indication que les données sont envoyées au serveur
	if(this.readyState == 4 && (this.status == 200 || this.status == 0)){
	    document.getElementById("logo-gif").style.display = "none";
	}
	else if(this.readyState < 4){
	    document.getElementById("logo-gif").style.display = "inline";
	}
    };
    xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/ajoutArticle.php",true);
    xhr.send(data);
    
    var titre = document.getElementById('titre').value;
    var miniature = document.getElementById('upload_miniature').value;
    var contenu = document.getElementById('contenu').value;
    if(miniature.trim() == ""){
	alert ("Vous devez choisir une miniature !");
	return false;
    }
    else if(titre.trim() == "" || titre.trim() == "TITRE"){
	alert("Vous devez compléter le titre !");
	return false;
    }
    else if(contenu.trim() ==  ""){
	alert ("Il faut écrire l'article !");
	return false;
    }
    else{
	xhr.open("POST","https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/ajoutArticle.php",true);
	xhr.send(data);
    }
    return false;
});

