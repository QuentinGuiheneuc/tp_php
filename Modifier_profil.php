<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();

if ($_SESSION['QUI'] == FALSE && !empty($_SESSION['IS_CONNECTED'] && $_POST)){
    try {
        $Nom = htmlspecialchars($_POST['nom']);
        $Prenom = htmlspecialchars($_POST['prenom']);
        $Age = htmlspecialchars($_POST['age']);
        $Description = htmlspecialchars($_POST['descrip']);
        $CV = htmlspecialchars($_POST['cv']);
        $quey = 
        'UPDATE users 
        SET nom = "'.$Nom.'" , prenom = "'.$Prenom.'", age = '.$Age.', description = "'.$Description.'", cv = "'.$CV.'"
        WHERE id = '.$_SESSION['id'] ;
        //var_dump($quey);
        $query = $pdo->prepare($quey);
        $query->execute();
        header('Location: profile_users.php');
        exit();
    }catch(Exception $e) { 
        header('Location: erreur.php');
    }
}
if ($_SESSION['QUI'] == TRUE && !empty($_SESSION['IS_CONNECTED'] && $_POST)){
    try {
        $Nom = htmlspecialchars($_POST['nom']);
        $Description = htmlspecialchars($_POST['descrip']);
        $quey = 
        'UPDATE entreprise
        SET nom = "'.$Nom.'", description = "'.$Description.'"
        WHERE id = '.$_SESSION['id'] ;
        //var_dump($quey);
        $query = $pdo->prepare($quey);
        $query->execute();
        header('Location: profile_entreprise.php');
        exit();
    }catch(Exception $e) { 
        header('Location: erreur.php');
    }
}
?>