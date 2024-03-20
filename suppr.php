<?php
if (isset($_GET["id"])){
    $id = $_GET["id"];

    $nomServer = "localhost";
$root = "root";
$mdp = "";
$database = "products";

// Connexion à la base de données
$connexion = new mysqli($nomServer, $root, $mdp, $database);
$rSql = "DELETE FROM CLIENTS WHERE ID =$id";
$resutlRsql = $connexion->query($rSql);


}

header("location: /projetphp/crud/index.php ") ;
exit;
?>