<?php
  session_start();
/*Affiche le formulaire de connexion*/
function afficheFormulaireC($p,$p_ok,$m_ok){
    $c ="<div class=\"login-box\">";
    $c .= "<h2>Connexion</h2>";
    $c .= "<form action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?auth=login\" method=\"post\">";
    $c .="<div class=\"user-box\">";
    $c .= "<input type=\"text\" name=\"pseudo\" id=\"pseudo\" pattern=\"\w*\" title=\"Les caractères spéciaux sauf '_' ne sont pas acceptés\" value=\"".$p."\" required><label for=\"pseudo\">PSEUDO</label></div>";
    if($p_ok == 0){
        $c .= "<p>Ce pseudo n'existe pas !</p>";
    }
    $c .= "<div class=\"user-box\"><input type=\"password\" name=\"password\" id=\"password\"  minlength=\"6\" title=\"6 caractère minimum\" required><label for=\"password\">MOT DE PASSE</label></div>";
    if($m_ok == 0){
        $c .= "<p>Mot de passe incorrecte !</p>";
    }
    $c .= "<input type=\"submit\" class=\"bouton_valid\" title=\"Connexion\" value=\"Se connecter\">";
    $c .= "</form>";
    $c .= "<a class=\"alt_co\" href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account?auth=signup\">Créer un compte</a></div>";
        echo $c;
}

function affiche_bodyC(){
    if( isset($_SESSION['pseudo']) || isset($_SESSION['statut']) ){
        echo "<p>Vous êtes déjà connecté !</p>";
        echo "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/\">Retour</a>";
    }
    else{
        if(isset($_POST['pseudo'],$_POST['password'])){
            include '../php/connex.inc.php';
            $pdo = connex('rg06871s','../');
            try{
                $ps = htmlspecialchars(trim($_POST['pseudo']));
                $mdp = htmlspecialchars(trim($_POST['password']));
                $stmt = $pdo->prepare("SELECT * FROM membres WHERE pseudo = ?");
                $stmt->execute(array($ps));
                $nb = $stmt->rowCount();
                if($nb==1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($mdp,$row['mdp'])){
                        $_SESSION['pseudo']=$ps;
                        $_SESSION['statut']=intval($row['statut']);
                        echo "<p>Vous êtes connecté !</p>";
                        echo "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/deconnexion.php\">Se déconnecter</a>";
                        if($_SESSION['statut']==0){
                            header('Location: https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/');
                        }
                    }
                    else{
                        afficheFormulaireC($p,1,0);
                    }
                }
                else{
                    afficheFormulaireC($p,0,1);
                }
                $pdo = null;
            }
            catch(PDOException $e){
                die("Erreur : Problèmes à l'éxécution");
            }
            
        }
        else{
            afficheFormulaireC(null,1,1);
        }
    }
}
?>