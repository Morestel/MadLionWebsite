<?php
session_start();
    if(isset($_SESSION['pseudo'],$_SESSION['statut'])){
        if(isset($_POST['contenu'],$_POST['id_article'])){
            include 'connex.inc.php';
            $pdo = connex('rg06871s','../');
            try{
                $pseudo = $_SESSION['pseudo'];
                $contenu = $_POST['contenu'];
                $date = date('Y-m-d H:i:s');
                $id_article = $_POST['id_article'];
                $stmt = $pdo->prepare("SELECT * FROM membres WHERE pseudo=?");
                $stmt->execute(array($pseudo));
                $nb = $stmt->rowCount();
                if($nb == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id_auteur = $row['usr_id'];
                    $stmt->closeCursor();
                    $stmt = $pdo->prepare("INSERT INTO commentaires(id_auteur,contenu,date_com,id_article) VALUES (?,?,?,?)");
                    $stmt->execute(array($id_auteur,$contenu,$date,$id_article));
                }
            }
            catch(PDOException $e){
                die("Erreur lors de la récuperation des données");
            }
        }
    }

?>
