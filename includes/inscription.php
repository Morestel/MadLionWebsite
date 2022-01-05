<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/account.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">

	<div class="login-box">
	  <h2>Inscription</h2>

	  <form method="post" id="form">
	    
	    <div class="user-box">
	      <input type="text" name="pseudo" id="pseudo" pattern="\w*" title="Caractères acceptés : lettres, chiffres, '_'" minlength="4" required>
	      <label for="pseudo">PSEUDO</label>
	      <p id="pseudo_error" style="display:none;">Ce pseudo est déjà utilisé !</p>
	    </div>

	    <div class="user-box">
	      <input type="email" name="email" id="email" pattern=".+@.+\..+" min-length="4" required>
	      <label for="pseudo">E-MAIL</label>
	      <p id="email_error" style="display:none;">Cet adresse est déjà utilisée !</p>
	    </div>

	    <div class="user-box">
	      <input type="password" name="password" id="password" minlength="6" title="6 caractères minimum !" required>
	      <label for="password">MOT DE PASSE</label>
	    </div>

	    <div class="user-box">
	      <input type="password" name="password_confirm" id="password_confirm" minlength="6" title="6 caractère minimum" required>
	      <label for="password_confirm">CONFIRMER LE MOT DE PASSE</label>
	    </div>
	    
	    <button type="button" id="bouton_invalid" class="bouton_invalid">S'inscrire</button>
	    <input type="submit" id="bouton_valid" class="bouton_valid" title="Valider" style="display:none" value="S'inscrire">
	  </form>
	  <a class="alt_co" href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/?auth=login">Vous avez déja un compte ?</a>
	</div>
	
      </div>
    </div>
    <?php include '../includes/footer.html'; ?>
    <script src="../js/inscription.js"></script>
  </body>
</html>
