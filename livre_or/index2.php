<?php
  session_start();
  include 'php/convertUrl.php';
  include 'php/connex.inc.php';
  $pdo = connex('rg06871s');
  try{
      $articles = $pdo->query("SELECT * FROM news ORDER BY publication DESC LIMIT 4");
      $forums = $pdo->query("SELECT * FROM forum ORDER BY nb_total_msg DESC LIMIT 4");
      $forums->closeCursor();
      $pdo = null;
  }
  catch(PDOException $e){
      die("Erreur lors de la récuperation des données");
  }
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>MAD LIONS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
  </head>
  <body>
    <?php
      include 'includes/header.html';
    ?>
    

    <div class="main">
      <section class="news">
        <h2>DERNIÈRES NEWS</h2>
        <ul class="list_news">
          <?php while( $art = $articles->fetch(PDO::FETCH_ASSOC) ){ ?>
          <li>
              <a href="news/<?= convertUrl($art['titre']) ?>">
		<article class="full-news-box">
		  <div class="news-box" style="background: url('https://mira2.univ-st-etienne.fr/~rg06871s/projet/img/news/<?=$art['illustration']?>')">
		    <div class="filtre"></div>
                    <h3><?= $art['titre'] ?></h3>
		  </div>
		  <div class="news-box-text">
		    <?= $art['contenu']?>
		  </div>
		</article>
              </a>
          </li>
          <?php } $articles->closeCursor() ?>
        </ul>
      </section>
      <section class="forums">
        <h2>FORUMS POPULAIRES</h2>
        <ul class="list_forums">
          <?php while($f = $forums->fetch(PDO::FETCH_ASSOC)){ ?>
          <li>
            <a href="forums/<?= $f['forum_name']?>/">
              <h3><?= $f['forum_name']?></h3>
            </a>
          </li>
          <?php } ?>
          </ul>
      </section>
      <?php include 'includes/sponsors.html';?>
    </div>
    <?php
       include 'includes/compte.php';
       include 'includes/footer.html';
       ?>
  </body>
</html>
