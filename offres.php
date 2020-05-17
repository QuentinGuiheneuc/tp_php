<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
if (!empty($_SESSION['IS_CONNECTED'])){
    if($_SESSION['QUI'] == TRUE){
        try {
        $id_entreprice = $_SESSION['id'];
        $Titre = htmlspecialchars($_POST['titre']);
        $type = htmlspecialchars($_POST['type']);
        $description_annonce = htmlspecialchars($_POST['descri']);
        var_dump($_SESSION);
        var_dump($id_entreprice);
            $query = $pdo->prepare('INSERT INTO annonce(id_entreprice,titre,type,description_annonce) VALUES(:id_entreprice, :titre, :type, :description_annonce)');
        
            $query->bindValue(':id_entreprice', $id_entreprice, PDO::PARAM_INT);
            $query->bindValue(':titre', $Titre);
            $query->bindValue(':type', $type, );
            $query->bindValue(':description_annonce',$description_annonce);
            $query->execute();
            header('Location: profile_entreprise.php');

        }catch(Exception $e) {
            echo "erreur du Poste";
            header('Location: erreur.php');
         }
    }
}
 ?>