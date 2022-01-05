<?php
function connex($base,$path = ""){
    include_once $path."php/param.inc.php";
    try {
        $pdo = new PDO("mysql:host=".HOTE.";dbname=".$base, UTILISATEUR, PASSE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Problème de connexion à la base de données";
        die();
    }
    return $pdo;                                                                                          
}                                                                                                       
?>
