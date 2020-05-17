<?php
include_once('config/pdo.php');
require_once('Manager/UserManager.php');
session_start();
if($_SESSION['QUI'] == FALSE){
    header('Location: profile_users.php');
}
if (!empty($_SESSION['IS_CONNECTED'])){
    try {
        $quey = "SELECT *
        FROM entreprise
        WHERE id = ".$_SESSION['id'];
        $query = $pdo->prepare($quey);
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result1 as $value){
            $_SESSION['nom'] = $value['nom']; 
            $_SESSION['descrp'] = $value['description']; 
        } 
        $Nom = $_SESSION['nom'];
        $Description = $_SESSION['descrp'];
    }catch(Exception $e) { 
        echo $e ;
    } 
    
    
 }else {
     header('Location: index.php');
 }
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <title>profile_entreprise</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Profile<?php echo " ".$Nom; ?></h1>
<a href="index.php">Annonce</a><br>
<a href="deconnexion.php">deconnexion</a>

<div>
<span>Votre Profil Actuel</span><br>
<span>Nom : <?php echo $Nom; ?></span><br>
<span>Description : <?php echo $Description; ?></span><br>
</div>
<div><br><br>
<h2>Modifier le Profil</h2><br>
<form action="Modifier_profil.php" method="post">
    <span>Nom : </span>
    <input type="text" name="nom" value="<?php echo $Nom; ?>"placeholder="Nom" /><br>
    <span>Description : </span>
    <input type="text" name="descrip" value="<?php echo $Description; ?>" placeholder="Description"/><br>
    <button class="btn btn-warning" type="submit">Modifier</button>
    <a type='submit'class="btn btn-danger" href="Basse.php?delentreprise=<?php echo $_SESSION['id']; ?>">Supprime</a>
</form>

</div><br>

<?php
    //var_dump($user);
?>
<h2>Poste une anonce</h2>
<form action="offres.php" method="post">
    <span>Titre</span>
    <input type="text" name="titre" placeholder="Titre" />
    <span>Type(CDI,..)</span>
    <input type="text" name="type" placeholder="" />
    <span>Description de l'annonce</span>
    <input type="text" name="descri" placeholder="Description de l'annonce"/>
    <button type="submit">Valide</button>
</form>
<div class="col-sm-12 table-responsive " style="width: 90%;  height: 500px;">
<table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>type</th>
                    <th>titre</th>
                    <th>description_annonce</th>
                </tr>
                </thead>
                <tbody >
                <?php
                    $quey = "SELECT a.id,a.id_entreprice,a.titre,a.type,a.description_annonce,e.nom
                    FROM annonce a INNER JOIN entreprise e ON (a.id_entreprice=e.id) WHERE a.id_entreprice = ".$_SESSION['id'];
                     $query = $pdo->prepare($quey);
                     $query->execute();
                     $result = $query->fetchAll(PDO::FETCH_ASSOC);
                     //var_dump($quey);
                    $i=0;
                    foreach($result as $value1){
                        
                            echo "<tr style='width: 224px;height: 125px;' >
                            <td>".$value1['type']."</td>
                            <td>".$value1['titre']."</td>
                            <td>".$value1['description_annonce']."</td>
                            <td><a href='reponce.php?id=".$value1['id']."'>Reponce</a>
                            <a href='Basse.php?del=".$value1['id']."'>Supprimer</a>
                            <a href='Modifier_annonce.php?mod=".$value1['id']."'>Modifier</a>
                            </td>
                            
                            </tr>";
                    }
                    
                ?>
                </tbody>
            </table>
</div>
</body>
</html>