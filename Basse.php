<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
if (isset($_GET['del']) && ($_GET['del']) > 0) {

    if ($_SESSION['QUI'] == TRUE && !empty($_SESSION['IS_CONNECTED'])){
        $query = $pdo->prepare('DELETE FROM annonce WHERE id = '.$_GET['del']);
        $query->execute();
        header('Location: profile_entreprise.php');
        exit();
    }
}
if (isset($_GET['deluser']) && ($_GET['deluser']) > 0) {

    if ($_SESSION['QUI'] == FALSE && !empty($_SESSION['IS_CONNECTED'])){
        $query = $pdo->prepare('DELETE FROM users  WHERE id = '.$_GET['deluser']);
        $query->execute();
        header('Location: deconnexion.php');
        exit();
    }
}
if (isset($_GET['delentreprise']) && ($_GET['delentreprise']) > 0) {

    if ($_SESSION['QUI'] == TRUE && !empty($_SESSION['IS_CONNECTED'])){
        $query = $pdo->prepare('DELETE FROM entreprise  WHERE id = '.$_GET['delentreprise']);
        $query->execute();
        header('Location: deconnexion.php');
        exit();
    }
}
if (isset($_GET['mod']) && ($_GET['mod']) > 0) {
 $_SESSION['mode'] = $_GET['mod'];
 var_dump($_SESSION);
}
if ($_SESSION['QUI'] == TRUE && !empty($_SESSION['IS_CONNECTED']) && $_POST['repondre']){
    try {
        $repondre = htmlspecialchars($_POST['repondre']);
        $quey = 
        'UPDATE poste_resp 
        SET  resp_entreprise = "'.$repondre.'"  
        WHERE id = '.$_SESSION['mode'] ;
        var_dump($quey."azertyuio");
        $query = $pdo->prepare($quey);
        $query->execute();

        header('Location: profile_entreprise.php');
        exit();
    }catch(Exception $e) { 
        header('Location: erreur.php');
    }
}
if ($_SESSION['QUI'] == TRUE && !empty($_SESSION['IS_CONNECTED']) && $_POST['titre']){
    try {
        $titre =  htmlspecialchars($_POST['titre']);
        $type = htmlspecialchars($_POST['type']);
        $description = htmlspecialchars($_POST['message1']);
        $quey = 
        'UPDATE annonce 
        SET titre = "'.$titre.'", type = "'.$type.'" , description_annonce = "'.$description.'"  
        WHERE id = '.$_SESSION['mode'] ;
        var_dump($quey);
        $query = $pdo->prepare($quey);
        $query->execute();

        header('Location: profile_entreprise.php');
        exit();
    }catch(Exception $e) { 
        header('Location: erreur.php');
    }
    

}

?>
