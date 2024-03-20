<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD CLIENTS</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery-1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>Listes de clients</h2>
    <a href="/projetphp/crud/add.php" class="btn btn-success my-2" role ="button">Ajouter un Nouveau Client</a><br>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Numero De Telephone</th>
                <th>Adress</th>
                <th>Date d'inscription</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomServer = "localhost";
            $root = "root";
            $mdp = "";
            $database = "products";

            //connexion a la base de donnees
            $connexion = new mysqli($nomServer, $root, $mdp, $database);

            //Verification de la connexion
            if($connexion->connect_error){
                die("Erreur de connexion : " . $connexion->connect_error);
            }

            //Creation de la requete de lecture
            $requeteForUser = "SELECT * FROM CLIENTS order by id";

            // Recuperation des resultat en lancant la requete avec query
            $resultUser = $connexion->query($requeteForUser);

            if(!$resultUser){
                die("Requete invalide : " . $connexion->error);
            }

            //Lecture des lignes
            
            while ($ligne = $resultUser->fetch_assoc()) {
                echo "<tr>
                            <td>" . $ligne['id'] . "</td>
                            <td>" . $ligne['name'] . "</td>
                            <td>" . $ligne['email'] . "</td>
                            <td>" . $ligne['phone'] . "</td>
                            <td>" . $ligne['address'] . "</td>
                            <td>" . $ligne['created_at'] . "</td>
                            <td>
                            <a href='/projetphp/crud/modif.php?id=" . $ligne['id'] . "' class='btn btn-primary btn-sm'>Modifier</a>
                            <a href='/projetphp/crud/suppr.php?id=" . $ligne['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>
                            </td>
                            </tr>";
            }
            ?>
            
        </tbody>
    </table>
</div>
</body>
</html>
