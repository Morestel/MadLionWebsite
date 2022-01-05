<?php
  session_start();
  include "php/connex.inc.php";
  $pdo = connex('rg06871s');
  try{
      $articles = $pdo->query("SELECT * FROM news ORDER BY publication DESC LIMIT 4");
      $articles->closeCursor();
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php
      include "includes/header.html";
    ?>
    
    <div class="main">
      <div class="main_content">
        <section class="news">
          <h2>DERNIÈRES NEWS</h2>
          <ul class="list_news">
            <li>
              <a href="#">
                <article class="full-news-box">
                  <div class="news-box" style="background : url(''):">
                    <h3>Yo</h3>
                    <div class="filtre"></div>
                  </div>
                  <div class="news-box-text"><p>Ici voilà un résumé de ce à quoi ressemblera les news. Ceci n'est qu'une ébauche, n'oubliez pas que Fuck Pup le gros nullos</p></div>
                  </div>
                </article>
              </a>
            </li>
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
        
<table width="80%"><tr><td>
        <form method="post" action="<?php echo $url; ?>" onSubmit="return testform(this.name,this.lemail,this.comment)">
        <input type="hidden" name="ajout" value="true">
        <table cellspacing="0" cellpadding="0" style="border: 1px solid white;" height="288">
            <tr>
                <td width="130"><font color="white">Nom</font></td>
                <td width="205"><input name="name" size="20"></td>
            </tr>
            <tr>
                 <td width="130"><font color="white">Votre Email :</font></td>
                 <td width="205"><font color="white"><input name="lemail" size="20"></font></td>
             </tr>
             <tr>
                 <td colspan="2">
                     <textarea name="comment" rows="4" cols="55"></textarea>
                     <br><br>
                     <input type="Submit" value="Valider">
                     <br><br>
                     <a href="#">Haut</a><br>
                 </td>
             </tr>
         </table>
         </form>
     </td></tr></table>


        <?php
          include "includes/sponsors.html";
           ?>
      </div>
    </div>
    <?php
      include "includes/compte.php";
    ?>
    <?php 
      include "includes/footer.html";
    ?>
  </body>
</html>
