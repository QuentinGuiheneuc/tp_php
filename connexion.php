<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');

session_start();
    $TYPE = htmlspecialchars($_POST['sel2']);
    
    $Nom = htmlspecialchars($_POST['nom']);
    isset($Prenom); 
    $Prenom = htmlspecialchars($_POST['prenom']);
    
    //adduser(htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['prenom']),htmlspecialchars($_POST['age']));
    if ($TYPE == "Demandeur"){
        try {
            $quey = "SELECT id,nom,prenom,age,description,cv FROM users WHERE nom = '$Nom' AND prenom = '$Prenom'";
            //var_dump($quey);
            $query = $pdo->prepare($quey );
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $value){
                if ($value['nom'] = $Nom && $value['prenom'] = $Prenom) {
                    $_SESSION['nom'] = $Nom;
                    $_SESSION['prenom'] = $Prenom;
                    $_SESSION['descrp'] = $value['descrption'];
                    $_SESSION['age'] = $value['age'];
                    $_SESSION['cv'] = $value['cv'];
                    $_SESSION['id'] = $value['id'];
                    $_SESSION['IS_CONNECTED'] = TRUE;
                };
                
                $_SESSION['QUI'] = FALSE;
               
            }
        }
        catch(Exception $e) {
            header('Location: erreur.php');
        } 
    }


    if($TYPE == "Entreprise") {

        try {
            $quey = "SELECT id,nom,description FROM entreprise WHERE nom = '$Nom'";
            $query = $pdo->prepare($quey);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $value){
                if ($value['nom'] = $Nom){
                    $_SESSION['nom'] = $value['nom'];
                    $_SESSION['id'] =$value['id'];
                    $_SESSION['descrip'] = $value['description'];
                    $_SESSION['IS_CONNECTED'] = TRUE;
                    $_SESSION['QUI'] = TRUE;
                   
                }
            }
         }catch(Exception $e) {
            header('Location: index.php');
         }    
    };
        ///var_dump($_SESSION);
        //var_dump($Nom);


if (!empty($_SESSION['IS_CONNECTED'])){
    if($_SESSION['QUI'] == TRUE){
        header('Location: profile_entreprise.php');
    }else {
        header('Location: profile_users.php');
    }
}

?>