<?php
session_start();
include 'convertUrl.php';
include 'connex.inc.php';
$pdo = connex('rg06871s', '../');

if (isset($_SESSION['pseudo'])){
    if (isset($_POST['contenu'])){
        $contenu = $_POST['contenu'];
        $pseudo = $_SESSION['pseudo'];
        $date = date('Y-m-d H:i:s');
        
        try{
            $stmt = $pdo->prepare('SELECT * FROM membres WHERE pseudo = ?');
            $stmt->execute(array($pseudo));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['usr_id'];
            $stmt->closeCursor();
            $stmt = $pdo->prepare('INSERT INTO livreor(pseudo_id, message, date) VALUES (?, ?, ?)');
            $stmt->execute(array($id, $contenu, $date));
            header('Location: https://mira2.univ-st-etienne.fr/~mt05697s/projet/livre_or/');
        }
        catch(PDOException $e){
            die("Erreur lors de la récupération de données");
        }
       
    }
}
?>      