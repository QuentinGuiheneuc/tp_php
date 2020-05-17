<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
if (isset($_GET['id']) && ($_GET['id']) > 0) {
    if ($_SESSION['QUI'] == TRUE){

        $query = $pdo->prepare('SELECT p.id,p.id_poste,p.resp_user,p.resp_entreprise,
        e.nom,e.prenom,e.age,e.description,e.cv,
        a.titre,a.type,a.description_annonce
        FROM poste_resp p
        INNER JOIN users e ON (p.id_user = e.id)
        INNER JOIN annonce a ON (a.id = p.id_poste)
        WHERE p.id_poste = "'.$_GET['id'].'"');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $quey = "SELECT a.id,a.id_entreprice,a.titre,a.type,a.description_annonce,e.nom
        FROM annonce a INNER JOIN entreprise e ON (a.id_entreprice=e.id) WHERE a.id = ".$_GET['id'];
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
var_dump($_SESSION);
}
?></div>

<div class="col-sm-12 table-responsive " style="width: 90%;  height: 400px;">
<table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>NOM</th>
                    <th>Prenom</th>
                    <th>Age</th>
                    <th>cv</th>
                    <th>description de users</th>
                    <th>message du poste</th>
                    <th>votre reponce</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody >
                <?php
                     //var_dump($quey);
                    $i=0;
                    foreach($result as $value1){
                       
                            echo '<tr style="width: 224px;height: 125px;" >
                            <td>'.$value1['nom']."</td>
                            <td>".$value1['prenom']."</td>
                            <td>".$value1['age']."</td>
                            <td>".$value1['cv']."</td>
                            <td>".$value1['description']."</td>
                            <td>".$value1['resp_user']."</td>
                            <td>".$value1['resp_entreprise']."</td>
                            <td><a type='submit' href='Repondre_user.php?user=".$value1['id']."'>Repondre</a></form>
                            </tr>";
                    };
                }
                
                ?>
                </tbody>
            </table>
</div>
<?php
   
?>

</body>
</html>