<?php
session_start();
if (isset($_GET['mod']) && ($_GET['mod']) > 0) {
    $_SESSION['mode'] = $_GET['mod'];
   }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'annonce</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Modifier l'annonce</h1>
<form action="Basse.php" method="post">
    <span>Titre</span>
    <input type="text" name="titre" placeholder="Titre" />
    <span>Type(CDI,..)</span>
    <input type="text" name="type" placeholder="" />
    <span>Description de l\'annonce</span>
    <input type="text" name="message1" placeholder="Description de l\'annonce"/>
    <button type="submit">Modifier</button>
</form>
<p></p>
</body>
</html>