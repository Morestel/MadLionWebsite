<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/account.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">

	<div class="login-box">
	  <h2>Connexion</h2>
	  <form method="post" id="form">
	    <div class="user-box">
	      <input type="text" name="pseudo" id="pseudo" pattern="\w*" title="Caractères acceptés : lettres, chiffres, '_'" minlength="4" required>
	      <label for="pseudo">PSEUDO</label>
	    </div>
	    <p id="pseudo_error" style="display:none">Ce pseudo n'existe pas !</p>
	    <div class="user-box">
	      <input type="password" name="password" id="password"  minlength="6" title="6 caractères minimums" required>
	      <label for="password">MOT DE PASSE</label>
	    </div>
	    <p id="pass_error" style="display:none">Mot de passe incorrect !</p>
	    <button type="button" id="bouton_invalid" class="bouton_invalid">Se connecter</button>
	    <input type="submit" id="bouton_valid" class="bouton_valid" style="display:none" title="Connexion" value="Se connecter">
	  </form>
	  <a class="alt_co" href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/account?auth=forget">Mot de passe oublié ?</a><br/>
	  <a class="alt_co" href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/account?auth=signup">Créer un compte</a>
	</div>
	
      </div>
    </div>
    <?php include '../includes/footer.html'; ?>
    <script src="../js/connexion.js"></script>
  </body>
</html>
