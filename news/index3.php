<?php
  session_start();
  include '../php/convertUrl.php';
  include '../php/connex.inc.php';
  $pdo = connex('rg06871s','../');
  try{
      if(isset($_POST['page']) && !empty($_POST['page'])){
          $page = intval($_POST['page']);
      }
      else{
          $page = 1;
      }
      $stmt = $pdo->query("SELECT COUNT(*) FROM news");
      $nb_articles = $stmt->fetchColumn();
      $nb_pages = intdiv($nb_articles,6)+1;
      $stmt->closeCursor();
      $start = ($page-1)*6;
      $stmt = $pdo->query("SELECT * FROM news ORDER BY publication DESC LIMIT ".$start.",6");
  }
  catch(PDOException $e){
      die("Erreur lors de la récuperation des données");
  }

  include '../includes/pagination.php';

?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>News</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="news">
        <h2>NEWS</h2>
         <?php if(isset($_SESSION['pseudo'],$_SESSION['statut'])){
            if($_SESSION['statut'] < 2 ){
                  ?>
      <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/news/add_news/" title="Ajouter"><img class="ajout" src="https://mira2.univ-st-etienne.fr/~mt05697s/projet/img/src/bouton_modif_news.png" alt="Ajouter article"></a>
      <?php } } ?>
      <div class="affiche_page">
        <?php affiche_pages($page,$nb_pages); ?>
      </div>
      <ul>
        <?php while($articles = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
        <li>
            <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/news/<?= convertUrl($articles['titre'])?>">
	      <article class="full-news-box">
                <?php if(isset($_SESSION['pseudo'],$_SESSION['statut'])){
            if($_SESSION['statut'] < 2){
                  ?>
            <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/news?action=modif&amp;id=<?= $articles['news_id'] ?>" title="Modifier"><img class="button_mod" src="https://mira2.univ-st-etienne.fr/~mt05697s/projet/img/src/bouton_modif2.png" alt="Modifier"></a>
            <a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/php/supprimer_articles.php?id=<?= $articles['news_id'] ?>" title="Supprimer"><img class="button_del" src="https://mira2.univ-st-etienne.fr/~mt05697s/projet/img/src/bouton_delete.png" alt="Supprimer"></a>
            <?php
              }?>
		  <div class="news-box" style="background: url('https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/news/<?=$articles['illustration']?>') no-repeat center;">
		  <div class="filtre"></div>
		  <h3><?= $articles['titre'] ?></h3>
		</div>
		<div class="news-box-text">
		  <?= $articles['contenu']?>
		</div>
	      </article>
            </a>
            <?php
              } ?>
        </li>
        <?php
          }
          $stmt->closeCursor();
          $pdo = null;
        ?>
      </ul>
      </div>
    </div>
    <?php include '../includes/compte.php';?>
    <?php include '../includes/footer.html';?>
  </body>
</html>