<?php
session_start();
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://mira2.univ-st-etienne.fr/~mt05697s/projet/css/forum.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    
    <div class="main">
      <div class="main_content">
        <div class="forum">
          <table cellspacing="0" class="bloc_forum">
            <tbody>
              <!-- Indication -->
              <tr>
                <td class="forum_part fcaption">Forum</td>
                <td class="sujets_part fcaption">Sujets</td>
                <td class="messages_part fcaption">Messages</td>
                <td class="lastmess_part fcaption">Dernier Message</td>
              </tr>
              <!-- Actualité -->
              <tr>
                <td colspan="4" class="header_forum">Actualité</td>
              </tr>
              <!-- Catégorie: Actualité -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/news/">News</a><div class="smalltext">Discutez des dernières news !</div></td>
                <td class="sujets_part col2">35</td>
                <td class="messages_part col3">100</td>
                <td class="lastmess_part col4">8-01-2020</td>
              </tr>
              <!-- Discussions libres -->
              <tr>
                <td colspan="4" class="header_forum">Discussions libres</td>
              </tr>
              <!-- Catégorie: Blabla -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/blabla/">Blabla</a><div class="smalltext">Un peu de blabla ?</div></td>
                <td class="sujets_part col2">12</td>
                <td class="messages_part col3">40</td>
                <td class="lastmess_part col4">8-05-2020</td>
              </tr>
              <!-- Catégorie: Espace Jeux -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/espace-jeux/">Espace jeux</a><div class="smalltext">Let's play !</div></td>
                <td class="sujets_part col2">68</td>
                <td class="messages_part col3">1540</td>
                <td class="lastmess_part col4">26-05-2020</td>
              </tr>
              <!-- Catégorie: Fan Art -->
               <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/fan-art/">Fan Art</a><div class="smalltext">Vous voulez partager votre passion pour MAD Lions ?</div></td>
                <td class="sujets_part col2">6</td>
                <td class="messages_part col3">10</td>
                <td class="lastmess_part col4">6-06-2020</td>
               </tr>

               <!-- Administration -->
                <tr>
                <td colspan="4" class="header_forum">Administration</td>
                </tr>
                
                <!-- Catégorie: Aider le site -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/aider-le-site/">Aider le site</a><div class="smalltext">Venez aider le site à se développer !</div></td>
                <td class="sujets_part col2">1</td>
                <td class="messages_part col3">2</td>
                <td class="lastmess_part col4">16-06-2020</td>
              </tr>
               <!-- Catégorie: Partenariat -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/partenariat/">Partenariat</a><div class="smalltext">Un partenariat ? C'est par ici</div></td>
                <td class="sujets_part col2">5</td>
                <td class="messages_part col3">12</td>
                <td class="lastmess_part col4">17-06-2020</td>
              </tr>
              <!-- Catégorie: MAD Cave -->
              <tr>
                <td class="forum_part col1"><a href="https://mira2.univ-st-etienne.fr/~rg06871s/projet/forums/mad-cave">MAD Cave</a><div class="smalltext">Cave secrète de l'élite</div></td>
                <td class="sujets_part col2">1</td>
                <td class="messages_part col3">10</td>
                <td class="lastmess_part col4">22-05-2020</td>
              </tr>      
            </tbody>

            
          </table>
        </div>
      </div>
    </div>
    <?php include '../includes/compte.php';?>
    <?php include '../includes/footer.html';?>
  </body>
</html>