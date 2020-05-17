<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();

if (!empty($_SESSION['IS_CONNECTED'])){
var_dump($_SESSION);
    try {
        $quey = "SELECT *
        FROM users
        WHERE id = ".$_SESSION['id'];
        $query = $pdo->prepare($quey);
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result1 as $value){
            $_SESSION['nom'] = $value['nom']; 
            $_SESSION['prenom'] = $value['prenom']; 
            $_SESSION['age'] = $value['age']; 
            $_SESSION['descrp'] = $value['description']; 
            $_SESSION['cv'] = $value['cv'];  
        } 
    }catch(Exception $e) { 
        header('Location: erreur.php');
    } 
   $Nom = $_SESSION['nom'];
   $Prenom = $_SESSION['prenom'];
   $age = $_SESSION['age'];
   $description = $_SESSION['descrp'];
   $cv = $_SESSION['cv'];
   if($_SESSION['QUI'] == TRUE){
    header('Location: profile_entreprise.php');
    exit;
}
}else {
    header('Location: index.php');
}
try {
    $quey = "SELECT a.titre,a.type,a.description_annonce,p.resp_user,p.resp_entreprise,en.nom
    FROM poste_resp p 
    INNER JOIN annonce a ON (p.id_poste = a.id) 
    INNER JOIN entreprise en ON (p.id_entreprise = en.id) 
    WHERE p.id_user = ".$_SESSION['id'];

    $query = $pdo->prepare($quey);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);    
}catch(Exception $e) { 
    header('Location: erreur.php');
} 
//var_dump($_SESSION);         
?>

<!DOCTYPE html>
<html>
<head>
    <title>profile_users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>profile_users</h1>
<a href="index.php">Annonce</a>
<a href="deconnexion.php">deconnexion</a>

<div>
<span>Votre Profil Actuel</span><br>
<span>Nom : <?php echo $Nom; ?></span><br>
<span>Prenom : <?php echo $Prenom; ?></span><br>
<span>age : <?php echo $age; ?></span><br>
<span>Description : <?php echo $description; ?></span><br>
<span>cv : <?php echo $cv; ?></span><br>
</div>
<div><br><br>
<h2>Modifier le Profil</h2><br>
<form action="Modifier_profil.php" method="post">
    <span>Nom : </span>
    <input type="text" name="nom" value="<?php echo $Nom; ?>"placeholder="Nom" /><br>
    <span>Prenom : </span>
    <input type="text" name="prenom" value="<?php echo $Prenom; ?>" placeholder="Prenom"/><br>
    <span>Age : </span>
    <input type="text" name="age"  value="<?php echo $age; ?>" placeholder="Age"/><br>
    <span>Description : </span>
    <input type="text" name="descrip" value="<?php echo $description; ?>" placeholder="Description"/><br>
    <span>CV : </span>
    <input type="text" name="cv" value="<?php echo $cv; ?>" placeholder="CV"/><br><br>
    <button class="btn btn-warning" type="submit">Modifier</button>
    <a type='submit'class="btn btn-danger" href="Basse.php?deluser=<?php echo $_SESSION['id']; ?>"">Supprime</a>
</form>

</div><br>
<div class="col-sm-12 table-responsive " style="width: 90%;  height: 400px;">
<table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>NOM Entreprise</th>
                    <th>Poste</th>
                    <th>Type</th>
                    <th>Description Annonce</th>
                    <th>Votre message du poste</th>
                    <th>La Reponce</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody >
                <?php
                     //var_dump($result);
                    $i=0;
                    foreach($result as $value1){
                        
                            echo '<tr style="width: 224px;height: 125px;" >
                            <td>'.$value1['nom']."</td>
                            <td>".$value1['titre']."</td>
                            <td>".$value1['type']."</td>
                            <td>".$value1['description_annonce']."</td>
                            <td>".$value1['resp_user']."</td>
                            <td>".$value1['resp_entreprise']."</td>
                            </tr>";
                    };
                ?>
                </tbody>
            </table>
</div>
</body>
</html>