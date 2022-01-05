<?php
  include '../php/connex.inc.php';
  $pdo = connex('rg06871s','../');
  try{
      $stmt = $pdo->query("SELECT * FROM membres ORDER BY statut");
  }
  catch(PDOException $e){
      die("Erreur : Problèmes à l'éxécution");
  } 
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Gérer les comptes</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/account.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">
	<h2>Compte administrateur : <?=$_SESSION['pseudo']?></h2>
	<a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/deconnexion.php">Se déconnecter</a>
	<table>
	  <thead>
	    <tr>
	      <th>Pseudo</th>
	      <th>Statut</th>
	      <th>Gérer</th>
	    </tr>
	  </thead>
	  <tbody>
	  <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
	    <td><?= $row['pseudo'] ?></td>
	    <td>
	      <form method="post" action="https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/statut_account.php?id=<?= $row['usr_id'] ?>">
		<select name="statut" class="statut">
		  <option value="0" <?php if($row['statut'] == 0){echo "selected";} ?>>Administrateur</option>
		  <option value="1" <?php if($row['statut'] == 1){echo "selected";} ?>>Rédacteur</option>
		  <option value="2" <?php if($row['statut'] == 2){echo "selected";} ?>>Modérateur</option>
		  <option value="3" <?php if($row['statut'] == 3){echo "selected";} ?>>Membre</option>
		</select>
		<input type="submit" value="Changer"/>
	      </form>
	    </td>
	    <td>
	      <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/supprimer_account.php?id=<?=$row['usr_id']?>">Supprimer</a>
	    </td> 
	  </tr>
	  <?php
            }
            $stmt->closeCursor();
            $pdo = null;
	  ?>
	  </tbody>
	</table>
      </div>
    </div>
    <?php include '../includes/footer.html'; ?>
    <script src="../js/admin.js"></script>
  </body>
</html>
