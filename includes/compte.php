<?php
echo "<header class=\"account\">";
if( !isset($_SESSION['pseudo'],$_SESSION['statut']) ){
    echo "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/inscription.php\">S'inscrire</a><a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/connexion.php\">Se connecter</a>";
}
else{
  echo "<p class=\"session_name\">".$_SESSION['pseudo']."</p><a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/deconnexion.php\">Se déconnecter</a>";
}
echo "</header>";
?>
