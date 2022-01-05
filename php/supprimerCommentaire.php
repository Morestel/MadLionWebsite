<?php

session_start();
if(isset($_SESSION['statut'])){
    if($_SESSION['statut'] == 0 || $_SESSION['statut'] == 2){
        include 'connex.inc.php';
        $pdo = connex('rg06871s','../');
        try{
            if(isset($_GET['id_com'])){
                $id = $_GET['id_com'];
                $stmt = $pdo->prepare("DELETE FROM commentaires WHERE id_com=?");
                $stmt->execute(array($id));
                $stmt->closeCursor();
                header('Location: '.$_SERVER['HTTP_REFERER']);
            }
        }
        catch(PDOException $e){
            die("Erreur lors de la récuperation des données");
        }
    }
}
else{
    header("Location: https://mira2.univ-st-etienne.fr/~rg06871s/projet/news/");
}

?>