<?php
session_start();
if(!isset($_SESSION['pseudo'],$_SESSION['statut'])){
    if(isset($_GET['auth']) && !empty($_GET['auth'])){
        $auth = htmlspecialchars(trim($_GET['auth']));
        if($auth == "signup"){
            include '../includes/inscription.php';
        }
        else if($auth == "login"){
            include '../includes/connexion.php';
        }
	else if($auth == "forget"){
            include '../includes/forget.php';
        }
        else{
            header('https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/');
        }
    }
    else{
        include '../includes/authentification.php';
    }
}
else if($_SESSION['statut'] > 0){
  header('Location: https://mira2.univ-st-etienne.fr/~rg06871s/projet/');
}
else{
  include '../includes/admin.php';
}
?>
