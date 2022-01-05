<?php
  include '../../php/connex.inc.php';
$pdo = connex('rg06871s','../../');
  try{
      $articles = $pdo->query("SELECT * FROM news WHERE news_id=".$id);
      $art = $articles->fetch(PDO::FETCH_ASSOC);
      $articles->closeCursor();
      
      $stmt = $pdo->query("SELECT * FROM commentaires LEFT JOIN membres ON usr_id=id_auteur WHERE id_article=".$id." ORDER BY date_com DESC");
      $date = new DateTime($art['publication']);
  }
  catch(PDOException $e){
      die("Erreur lors de la récuperation des données");
  }
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?= $art['titre'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/news.css">
  </head>
  <body>
    <?php
      include '../../includes/header.html';
    ?>
    <div class="main">
      <div class="main_content">
	<div class="miniature" style="background: center / cover no-repeat url('https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/news/<?= $art['illustration'] ?>')">
	  <div class="filtre"></div>
	  <h2><?= $art['titre']?></h2>
	  <p class="date"><?= date_format($date,'d-m-Y'); ?></p>
	</div>
	<div class="box_contenu"><?= $art['contenu'] ?></div>
	<div class="espace_com">
	  <div class="ajout_com">
	    <span class="nb_commentaires"> commentaires</span>
	    <form method="post" id="leform">
	      <span class="avatar">
		<img src="https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/avatar/" alt="avatar">
	      </span>
	      <input type="text" name="id_article" value="<?=$id?>" style="display:none">
	      <textarea id="lecontenu" name="contenu" required></textarea>
	      <?php if(!isset($_SESSION['pseudo'],$_SESSION['statut'])){?>
	      <button onclick="alert('Vous devez être connecté pour mettre un commentaire');">POSTER</button>
	      <?php }else{ ?>
	      <input type="submit" value="POSTER" id="button_submit">
	      <?php } ?>
	    </form>
	  </div>
	  <div class="commentaires">
	    <?php while($com = $stmt->fetch(PDO::FETCH_ASSOC)){?>
	    <article class="com">
	      <span class="avatar">
		<img src="https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/avatar/<?=$com['avatar']?>" alt="avatar">
	      </span>
	      <p class="auteur"><?= $com['pseudo'] ?><span class="date_post"><?= $com['date_com'] ?></span></p>
	      <div class="contenu_post"><?= $com['contenu'] ?></div>
	      <?php
               if(isset($_SESSION['statut'])){
                   if($_SESSION['statut'] == 0 || $_SESSION['statut'] == 2){
          ?>
	      <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/supprimerCommentaire.php?id_com=<?= $com['id_com'] ?>">Supprimer</a>
	      <?php
               }
              }
          ?>
	    </article>
	    <?php }?>
	  </div>
	</div>
      </div>
    </div>
    <?php
      include '../../includes/compte.php';
      include '../../includes/footer.html';
       ?>
    <script src="../../js/article.js"></script>
  </body>
</html>
