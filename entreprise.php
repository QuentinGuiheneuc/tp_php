<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');

$user_controller = new UserManager($pdo);
$liste_users = $user_controller->getAllUserent();
?>

<!DOCTYPE html>
<html>
<head>
    <title>List User</title>
</head>

<body>
<h1>Ma page de SESSION</h1>

<?php
if(!empty($liste_users)){
    foreach ($liste_users as $user){
        echo "<p>".$user->nom().' '.$user->prenom().' '."</p>";
    }
} else {
    echo "<h1>Pas de user</h1>";
}

?>

</body>
</html>