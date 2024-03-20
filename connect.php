<?php
require_once("baseConnexion.php");
extract($_POST);
if($_POST['connectButton'] == 1){
    $requeteVerif = $connexion->prepare("SELECT username,mdp FROM permit_users 
    WHERE username = ? and mdp = ?");
    
    $requeteVerif -> execute([$username,$mdp]);
    
    $recupUser = $requeteVerif->fetch();

    if( $recupUser['username'] == $username && $recupUser['mdp'] == $mdp){
        header("location:index.php");
    }
    else{
        header("location : authent.php?msg=1");
    }

}

