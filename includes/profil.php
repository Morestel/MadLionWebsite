<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/news.css">
    <link rel="stylesheet" type="text/css" href="../css/account.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    
    <div class="main">
      <div class="main_content">
        <div class="profil">
          <img src="../img/src/ProduitLaitier.png">
          <span class="pseudo">MystKun</span>
          <span class="email">abdulgaming3524@gmail.com</span>
          <div class="box">
          <input type="email" name="changemail" id="changemail" placeholder="Changer d'email" pattern=".+@.+\..+"  minlength="4" required>
          
	  <input type="password" name="password" id="password" placeholder="Changer de mot de passe"  minlength="6" title="6 caractères minimum !" required>
	  <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe" minlength="6" title="6 caractère minimum" required>
          </div>

          <button type="button" id="bouton_invalid" class="bouton_valid">Valider</button>
          
        </div>
      </div>
    </div>
    <?php include '../includes/compte.php';?>
    <?php include '../includes/footer.html';?>
  </body>
</html>