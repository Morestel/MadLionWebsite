<?php
  session_start();
function afficheFormulaire($p,$p_ok,$mp_ok){
      $c = "<form action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\" method=\"post\" class=\"box_form\">";
      $c .= "<label for=\"pseudo\">PSEUDO</label><input type=\"text\" name=\"pseudo\" id=\"pseudo\" pattern=\"\w*\" title=\"Les caractères spéciaux sauf '_' ne sont pas acceptés\" value=\"".$p."\" required>";
      if ($p_ok == 0){
          $c .= "<p>Ce pseudo est déjà utilisé !</p>";
      }
      $c .= "<label for=\"password\">MOT DE PASSE</label><input type=\"password\" name=\"password\" id=\"password\" required>";
      $c .= "<label for=\"password_confirm\">CONFIRMER LE MOT DE PASSE</label><input type=\"password\" name=\"password_confirm\" id=\"password_confirm\" required>";
      if ($mp_ok == 0){
          $c .= "<p>Les mots de passe ne correspondent pas !</p>";
      }
      $c .= "<input type=\"submit\" class=\"bouton_valid\" title=\"Valider\" value=\"\">";
      $c .= "<a href=\"connexion.php\">Vous avez déja un compte ?</a>";
      $c .= "</form>";
      echo $c;
  }
function affiche_body(){
  if(isset($_SESSION['pseudo']) || isset($_SESSION['statut'])){
      header('Location: https://mira2.univ-st-etienne.fr/~rg06871s/projet/');
  }else{
      if(isset($_POST['pseudo'],$_POST['password'],$_POST['password_confirm'])){
          include '../php/connex.inc.php';
          $pdo = connex('rg06871s','../');
          try{
             $ps = htmlspecialchars(trim($_POST['pseudo']));
             $stmt = $pdo->prepare("SELECT * FROM membres WHERE pseudo = ?");
             $stmt->execute(array($ps));
             $nb = $stmt->rowCount();
             if($nb==1){
                 afficheFormulaire($ps,0,1);
             }
             else{
                 if(strcmp($_POST['password'],$_POST['password_confirm']) != 0){
                     afficheFormulaire($ps,1,0);
                 }
                 else{
                     $mdp = password_hash(htmlspecialchars(trim($_POST['password'])),PASSWORD_DEFAULT);
                     $stmt->closeCursor();
                     $stmt = $pdo->prepare("INSERT INTO membres (pseudo,mdp,statut) VALUES (?,?,'3')");
                     $stmt->execute(array($ps,$mdp));
                     $nb = $stmt->rowCount();
                     $c = "<div class=\"box_form\">";
                     if($nb==1){
                         $c .= "<p>Vous avez bien été inscrit !</p>";
                         $c .= "<a href=\"connexion.php\">Se connecter</a>";
                     }
                     else{
                         $c .= "<p>Erreur lors de l\'ajout</p>";
                     }
                     $c .= "<div>";
                     echo $c;
                 }
             }
             $stmt = closeCursor();
             $pdo = null;
          }
          catch(PDOException $e){
              die("Erreur : Problèmes à l'éxécution");
          }
      }
      else{
          afficheFormulaire(null,1,1);
      }
  }
}
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <?php affiche_body(); ?>
    
    <?php include '../includes/footer.html'; ?>
  </body>
</html>
