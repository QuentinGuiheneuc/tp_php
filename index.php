<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
$query = $pdo->prepare(
    'SELECT a.id,a.id_entreprice,a.titre,a.type,a.description_annonce,e.nom
     FROM annonce a INNER JOIN entreprise e ON (a.id_entreprice=e.id)'
     );
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
     
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test session</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Annonce</h1>

<a href="users.php">listes users</a><br>
<a href="entreprise.php">listes entreprise</a><br><br>
<?php 
    if (!empty($_SESSION['IS_CONNECTED'])){
        if (!empty($_SESSION["prenom"])){
            echo '<a href="deconnexion.php">Deconnexion</a><br>
            <a href="profile_users.php">'.$_SESSION["nom"].' '.$_SESSION["prenom"].'</a>';
        }else {
            echo '<a href="deconnexion.php">Deconnexion</a><br>
            <a href="profile_users.php">'.$_SESSION["nom"].'</a>';
        }
        
    }else {

    echo '
    <a href="inscription.php">Inscription</a><br>
    <form action="connexion.php" method="post">
        <input style="width: 224px;height: 31px; margin: 10px;" type="text" name="nom" placeholder="nom ou le nom de l\'entreprise" />
        <input type="text" name="prenom" placeholder="prenom"/>
        <select id="sel2" name="sel2" >
            <option>Demandeur</option>
            <option>Entreprise</option>
        </select>
        <button type="submit">Valide</button>
    </form>';
    }
    if (!empty($_SESSION['IS_CONNECTED'])){
    foreach($result as $value){
        echo "
        <div style='margin: 20px;'>
            <h2>".$value['titre']."</h2>
            <h4>Type : ".$value['type']."</h3>
            <span>Entreprise : ".$value['nom']."</span>
            <p>Description : ".$value['description_annonce']."</p>
            <a href='postule.php?id=".$value['id']."'>Postule</a>
        </div>";
    }
    } else {
        foreach($result as $value){
            echo "
            <div>
                <h2>".$value['titre']."</h2>
                <h3>Type : ".$value['type']."</h3>
                <p>Description : ".substr($value['description_annonce'],0,100)." ...</p>
                <a></a>
            </div>";
        };
    };
?>

</body>
</html>
