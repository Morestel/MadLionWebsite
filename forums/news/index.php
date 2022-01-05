<!-- Importer cette partie dans chaque fichier du forum -->
<?php
session_start();
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Forum: News</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/forum.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include '../../includes/header.html'; ?>
     <div class="main">
      <div class="main_content">
        <div class="forum">
          <!-- Fin importation -->

          <table cellspacing="0" class="fborder">
            <tbody>
	      <tr>
	        <td class="header_forum"><a class="forumlink" href="https://~rg06871s/projet/forums/">Forum</a> - News</td>
	      </tr>
	      <tr>
	        <td class="casetype1">
	          <span class="mediumtext">Actualité - News</span></td>
	      </tr>
              </tbody>
	    </table>


            <br/>
            <br/>
            <br/>
          
            <table cellspacing="0" class="bloc_forum">
              <tbody>
                <!-- Indication -->
                <tr>
                  <td class="sujets_cat fcaption">Sujet</td>
                  <td class="rep_cat fcaption">Rép</td>
                  <td class="vues_cat fcaption">Vues</td>
                  <td class="auteur_cat fcaption">Auteur</td>
                  <td class="lastmess_cat fcaption">Dernier Message</td>
                </tr>
                <tr>
                  <td class="sujets_cat col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/news/">News du 11 Septembre</a></td>
                  <td class="rep_cat col2">6</td>
                  <td class="vues_cat col3">700</td>
                  <td class="auteur_cat col4">Dudule</td>
                  <td class="lastmess_cat col5">08-06-2019</td>
                </tr>
              </tbody>
            </table>
            

          <!-- Importer cette partie dans chaque fichier du forum -->
           </div>
      </div>
    </div>
    <?php include '../../includes/compte.php';?>
    <?php include '../../includes/footer.html';?>
  </body>
</html>