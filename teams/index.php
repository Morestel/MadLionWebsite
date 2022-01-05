<?php
session_start();
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Teams</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/team.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include '../includes/header.html'; ?>
    <div class="main">
      <div class="main_content">
        <div class="main_team">
          
          <button class="accordion">League of Legends <div class="logo-jeu"><img src="http://mira2.univ-st-etienne.fr/~mt05697s/projet/img/src/lol_logo.png" alt="League of Legends Logo"/></div></button>
          <div class="panel">
            <ul>
              <li>ANDREI <span class="ita bold">"Orome"</span> POPA: Toplaner</li>
              <li>ZHIQIANG <span class="ita bold">"Shadow"</span> ZHAO: Jungler</li>
              <li>MAREK <span class="ita bold">"Humanoid"</span> BRÁZDA: Midlaner</li>
              <li>MATYÁŠ <span class="ita bold">"Carzzy"</span> ORSÁG: ADC</li>
              <li>NORMAN <span class="ita bold">"Kaiser"</span> KAISER: Support</li>
              <li>JAMES <span class="ita bold">"Mac"</span> MACCORMACK (Coach)</li>
              </ul>
          </div>
          
          <button class="accordion">Counter-Strike<div class="logo-jeu"><img src="http://mira2.univ-st-etienne.fr/~mt05697s/projet/img/src/CS_logo.png" alt="CS GO logo"/></div></button>
          <div class="panel">
            <ul>
              <li>FREDERIK <span class="ita bold">"acoR"</span> GYLDSTRAND</li>
              <li>RASMUS <span class="ita bold">"sjuush"</span> BECK</li>
              <li>LUCAS <span class="ita bold">"Bubzkji"</span> ANDERSEN</li>
              <li>FREDRIK <span class="ita bold">"roeJ"</span> JØRGENSEN</li>
              <li>ASGER <span class="ita bold">"AcilioN"</span> GRUNNET LARSEN</li>
              <li>LUIS <span class="ita bold">"peacemaker"</span> TADEUS (Coach)</li>
              </ul>
          </div>
          
        </div>
      </div>
    </div>
    <?php include '../includes/compte.php';?>
    <?php include '../includes/footer.html';?>
    
    <script src="../js/accordion.js"></script>
    
  </body>
</html>