<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/account.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">
	<div class="box_accounti">
	  <p>Pas de compte ?</p>
	  <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/?auth=signup">
	    <button class="bouton" type="button">
	      <span>S'inscrire</span>
	    </button>
	  </a>
	</div>
	<div class="box_accountc">
	  <p>J'ai un compte</p>
	  <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/account/?auth=login">
	    <button class="bouton" type="button">
	      <span>Se connecter</span>
	    </button>
	  </a>
	</div>
      </div>
    </div>
    <?php include '../includes/footer.html'; ?>
  </body>
</html>
