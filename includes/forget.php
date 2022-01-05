<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Récupération de compte</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/account.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">

	<div class="login-box">
	  <h2>Récupération de mot de passe</h2>
	  
	  <form method="post" id="form_pseudo">
	    <div class="user-box">
	      <input type="text" name="pseudo" id="pseudo" pattern="\w*" title="Caractères acceptés : lettres, chiffres, '_'" minlength="4" required>
	      <label for="pseudo">PSEUDO</label>
	    </div>
	    <p id="pseudo_error" style="display:none">Ce pseudo n'existe pas !</p>
	    <button type="button" id="pseudo_invalid" class="bouton_invalid">Suivant</button>
	    <input type="submit" id="pseudo_valid" class="bouton_valid" style="display:none" title="Suivant" value="Suivant">
	  </form>
	  
	  <form method="post" id="form_code" style="display:none">
	    <div class="user-box">
	      <input type="text" name="code1" id="code1" class="code" maxlength="1" required>
	      <input type="text" name="code2" id="code2" class="code" maxlength="1" required>
	      <input type="text" name="code3" id="code3" class="code" maxlength="1" required>
	      <input type="text" name="code4" id="code4" class="code" maxlength="1" required>
	      <label for="code">CODE</label>
	    </div>
	    <p id="code_error" style="display:none">Code incorrecte !</p>
	    <p>Vous avez reçu un code par mail</p>
	    <button type="button" id="code_invalid" class="bouton_invalid">Suivant</button>
	    <input type="submit" id="code_valid" class="bouton_valid" style="display:none" title="Suivant" value="Suivant">
	  </form>
	  
	  <form method="post" id="form_mdp" style="display:none">
	    <div class="user-box">
	      <input type="password" name="password" id="password" minlength="6" title="6 caractères minimums !" required>
	      <label for="password">MOT DE PASSE</label>
	    </div>
	    <div class="user-box">
	      <input type="password" name="password_confirm" id="password_confirm" minlength="6" title="6 caractères minimums" required>
	      <label for="password_confirm">CONFIRMER LE MOT DE PASSE</label>
	    </div>
	    <p id="pass_error" style="display:none">Mot de passe incorrect !</p>
	    <button type="button" id="bouton_invalid" class="bouton_invalid">Changer mot de passe</button>
	    <input type="submit" id="bouton_valid" class="bouton_valid" style="display:none" title="Changer" value="Changer mot de passe">
	  </form>

	  <button id="connex_button" class="bouton_valid"  style="display:none">Se connecter</button>
	  
	</div>
	
      </div>
    </div>
    <?php include '../includes/footer.html'; ?>
    <script src="../js/forget.js"></script>
  </body>
</html>
