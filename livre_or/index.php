<?php
  session_start();
  include '../php/convertUrl.php';
  include '../php/connex.inc.php';
  $pdo = connex('rg06871s', '../');
try{
    $stmt = $pdo->query('SELECT membres.pseudo, membres.avatar, message, date FROM livreor LEFT JOIN membres ON livreor.pseudo_id = membres.usr_id ORDER BY livre_id DESC ');
}
catch(PDOException $e){
    die("Erreur lors de la récupération des données");
}

?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>MAD LIONS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/livreor.css">
    
  </head>
  <body>
    <?php
      include '../includes/header.html';
    ?>
    <div class="main">
      <div class="main_content">
        <div class="livre">
        <table cellspacing="0" class="bloc_livre">
          <tbody>
            <!-- En-tête-->
            <tr>
              <td class="auteur_li fcaption">Auteur</td>
              <td class="message_li fcaption">Message</td>
            </tr>
            <!-- Message-->
            
              <?php
    while($livre = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
              <tr>
                                                    <td class="auteur_li colaut"><?= $livre['pseudo']; ?><div><img class="avatar" src="https://<?=$livre['avatar']?>" alt="Avatar"></div><div class="smalltext"><?= $livre['date']; ?></div></td>
                <td class="message_li colmess"><span class="mediumtext"><?= $livre['message']; ?></span></td>
              </tr>
              <?php
    } ?>
          </tbody>
</table>


<?php
   if(isset($_SESSION['pseudo'],$_SESSION['statut'])){ ?>
<form method="post" action="../php/signer.php" id="form">
  <textarea id="signer_livre" placeholder="Un petit message ?" name="contenu"></textarea>
  <button id="submit_button" type="submit">POSTER</button>
</form>
<?php } ?>
        </div>
      </div>
    </div>
    <?php
               include '../includes/compte.php';
      include '../includes/footer.html';
       ?>
  </body>
</html>
