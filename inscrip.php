<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');

session_start();
    $TYPE = htmlspecialchars($_POST['sel1']);
    $Nom = htmlspecialchars($_POST['nom']);
    $Prenom  = htmlspecialchars($_POST['prenom']);
    $Age = htmlspecialchars($_POST['age']);
    $description = htmlspecialchars($_POST['descrip']);
    $cv = htmlspecialchars($_POST['cv']);

    $_SESSION['IS_CONNECTED'] = TRUE;
    if ($TYPE =="Demandeur"){
        
        $query = $pdo->prepare('INSERT INTO users(nom,prenom,age,description,cv) VALUES(:nom, :prenom, :age, :description, :cv)');
        $query->bindValue(':nom', $Nom);
        $query->bindValue(':prenom', $Prenom);
        $query->bindValue(':age', $Age, PDO::PARAM_INT);
        $query->bindValue(':description', $description);
        $query->bindValue(':cv', $cv);
        $query->execute();
        $_SESSION['prenom'] = $Prenom ;
        $_SESSION['nom'] = $Nom;
        $_SESSION['age'] = $Age;
        $_SESSION['cv'] = $cv;
        $_SESSION['descrp'] = $description;
    }
    if ($TYPE == "Entreprise"){
        $_SESSION['nom'] = $Nom;
        $_SESSION['description'] =  $description;
    
        $query = $pdo->prepare('INSERT INTO entreprise(nom,description) VALUES(:nom, :description)');

        $query->bindValue(':nom', $Nom);
        $query->bindValue(':description', $description);
        $query->execute();
    }

    var_dump($TYPE);
if (!empty($_SESSION['IS_CONNECTED'])){
    header('Location: index.php');
}



?>