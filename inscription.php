<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
<h1>Ma page de Inscription</h1>

<form action="inscrip.php" method="post">
    <input type="text" name="nom" placeholder="nom" />
    <input type="text" name="prenom" placeholder="prenom"/> 
    <input type="text" name="age" placeholder="age"/>
    <input type="text" name="descrip" placeholder="descrip"/>
    <input type="text" name="cv" placeholder="cv"/>
    <select id="sel1" name="sel1" >
        <option>Demandeur</option>
        <option>Entreprise</option>
    </select>
    
    <button type="submit">Valide</button>
</form>

</body>
</html>