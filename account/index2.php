<?php
  session_start();
  include '../includes/inscription.php';
  include '../includes/connexion.php';

  /*Ce qu'affiche la page si l'utilisateur n'est pas connecté*/
  function nonConnecte(){
      $c = "<div class=\"box_accounti\"><p>Pas de compte ?</p>";
      $c .= "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/?auth=signup\"><button class=\"bouton\" type=\"button\"><span>S'inscrire</span></button></a></div>";
      $c .= "<div class=\"box_accountc\"><p>J'ai un compte</p>";
      $c .= "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/?auth=login\"><button class=\"bouton\" type=\"button\"><span>Se connecter</span></a></div>";
      echo $c;
  }

  /*Affiche le formulaire d'insciption*/
  function afficheIncription(){
      affiche_body();
  }
  /*Affiche le formulaire de connexion*/
  function afficheConnexion(){
      affiche_bodyC();
  }

  /*Affiche un compte administrateur pour gérer les comptes*/
  function afficheCompte(){
      echo "Compte administrateur : ".$_SESSION['pseudo'];
      echo "<a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/deconnexion.php\">Se déconnecter</a>";
      include '../php/connex.inc.php';
      $pdo = connex('rg06871s','../');
      try{
          $stmt = $pdo->query("SELECT * FROM membres ORDER BY statut");
          echo "<table><tr><th>Pseudo</th><th>Statut</th><th>Gérer</th></tr>";
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              echo "<tr>";
              echo "<td>".$row['pseudo']."</td>";
              echo "<td><form action=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/statut_account.php?pseudo=".$row['pseudo']."\" method=\"post\">";
              echo "<select name=\"statut\" class=\"statut\">";
              if($row['statut']==0){
                  echo "<option value=\"0\" selected>Administrateur</option>";
              }
              else{
                echo "<option value=\"0\">Administrateur</option>";  
              }
              if($row['statut']==1){
                  echo "<option value=\"1\" selected>Rédacteur</option>";
              }
              else{
                echo "<option value=\"1\">Rédacteur</option>";  
              }
              if($row['statut']==2){
                  echo "<option value=\"2\" selected>Modérateur</option>";
              }
              else{
                echo "<option value=\"2\">Modérateur</option>";  
              }
              if($row['statut']==3){
                  echo "<option value=\"3\" selected>Membre</option>";
              }
              else{
                echo "<option value=\"3\">Membre</option>";  
              }
              echo "</select>";
              echo "<input type=\"submit\" value=\"Changer\"/>";
              echo "</form></td>";
              echo "<td><a href=\"https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/supprimer_account.php?pseudo=".$row['pseudo']."\">Supprimer</a></td>";
              echo "</tr>";
              
              $pdo = null;
          }
          echo "</table>";
      }
      catch(PDOException $e){
          die("Erreur : Problèmes à l'éxécution");
      }
  }
  
  /*Affiche le contenu de la page en fonction de la situation*/
  function affichePage($a){
      if($a == 0){
          nonConnecte();
      }
      if($a == 1){
          afficheIncription();
      }
      if($a == 2){
          afficheConnexion();
      }
      if($a == 3){
          afficheCompte();
      }
  }
  /*On verifie la situation*/
  if(!isset($_SESSION['pseudo'],$_SESSION['statut'])){
      if(isset($_GET['auth'])){
          $auth = htmlspecialchars(trim($_GET['auth']));
          if(strcmp($auth,"signup") == 0){
              $affichage = 1;
              $title = "Inscription";
          }
          if(strcmp($auth,"login") == 0){
              $affichage = 2;
              $title = "Connexion";
          }
      }
      else{
          $affichage = 0;
          $title = "Compte";
      }
  }
  else{
      if($_SESSION['statut'] == 0){
          $title = "Gérer les comptes";
          $affichage = 3; 
      }
      else{
          header('Location: '.htmlspecialchars($_SERVER['HTTP_REFERER']));
      }
      
  }
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">
      <?php
      affichePage($affichage);
         ?>
      </div>
    </div>
    <?php include '../includes/footer.html';?>
  </body>
</html>