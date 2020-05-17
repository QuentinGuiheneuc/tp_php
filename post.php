<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
//var_dump($_SESSION);
//var_dump($resp_entreprise);
try {
    $resp_entreprise = htmlspecialchars($_POST['message1']);
    var_dump(htmlspecialchars($_POST['message1']));
    $id_entreprise = $_SESSION['id_entreprise'];
    $id_user = $_SESSION['id'];
    $id_poste = $_SESSION['id_poste'];
    $resp_user = null;
    $quey =
    'INSERT INTO poste_resp(id_poste,id_user,id_entreprise,resp_user) 
    VALUES('.$id_poste.','. $id_user.','.$id_entreprise.', "'. $resp_entreprise.'")';
    //var_dump($_SESSION);
    var_dump($quey);
    
    $query = $pdo->prepare($quey);
        $query->execute();
        header('Location: index.php');
} catch(Exception $e) {
    header('Location: erreur.php');
} 

?>