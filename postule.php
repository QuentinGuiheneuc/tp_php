<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Postule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Postule</h1>


<?php

if (isset($_GET['id']) && ($_GET['id']) > 0) {
    $_SESSION['id_poste'] = $_GET['id'];
    $query = $pdo->prepare(
        'SELECT a.id_entreprice,a.titre,a.type,a.description_annonce,e.nom
         FROM annonce a INNER JOIN entreprise e ON (a.id_entreprice=e.id) WHERE a.id ='.$_GET['id'].''
         );
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $value){
        echo "
        <div style='margin: 20px;'>
            <h2>".$value['titre']."</h2>
            <h4>Type : ".$value['type']."</h3>
            <span>Entreprise : ".$value['nom']."</span>
            <p>Description : ".$value['description_annonce']."</p>
        </div>";
        $_SESSION['Type'] = $value['type'];
        $_SESSION['id_entreprise'] = $value['id_entreprice'];
    }
}
var_dump($_SESSION);
?>
<form action="post.php" method="post">
    <input type="text" name="message1" placeholder="message"/> 
    <button type="submit">Postuler</button>
</form>

</body>
</html>
