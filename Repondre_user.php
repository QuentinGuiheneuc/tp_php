<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
if (isset($_GET['user']) && ($_GET['user']) > 0) {
    $_SESSION['mode']= htmlspecialchars($_GET['user']);
    $quey = 'SELECT p.id,
    e.nom,e.prenom,
    a.titre,a.type,a.description_annonce
    FROM poste_resp p
    INNER JOIN users e ON (p.id_user = e.id)
    INNER JOIN annonce a ON (a.id = p.id_poste)
    WHERE p.id = "'.$_GET['user'].'"';

        //var_dump($quey);
        $query = $pdo->prepare($quey);
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reponce</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Reponce</h1>
<a href="index.php">Annonce</a><br>
<a href="deconnexion.php">deconnexion</a><br>
<?php echo '<a href="profile_users.php">'.$_SESSION["nom"].'</a>';?>
<div><?php 
foreach($result1 as $value){
echo '<h2>'.$value['titre'].'</h2>';
echo '<h3>'.$value['type'].'</h3>';
echo '<p>'.$value['description_annonce'].'</p>';
//var_dump($result1);

?></div>
<span>Repondre a <?php echo $value['nom'] . " " .$value['prenom']; }?></span>
<form action="Basse.php" method="post">
    <input type="text" name="repondre" placeholder="Votre Reponce"/>
    <button type="submit">Valide</button>
</form>
</body>
</html>