<?php
// Accès à la base de données
$nomServeur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$database = "products";

// Création de la connexion
$connexion = new mysqli($nomServeur, $nomUtilisateur, $motDePasse, $database);

// Verification de la connexion
if ($connexion->connect_error) {
    die("La connexion a echoue : " . $connexion->connect_error);
}

// Recuperation des donnees du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUtilisateur = $_POST["username"];
    $motDePasse = $_POST["userMdp"];

    // Requête preparee
    $requete = "SELECT id, username, userMdp FROM permit_users WHERE username = ?";
    $statement = $connexion->prepare($requete);
   // $statement->bind_param("s", $username);
    $statement->execute();
    $resultat = $statement->get_result();

    if ($resultat->num_rows == 1) {
        // Utilisateur trouver, verification du mot de passe
        $utilisateur = $resultat->fetch_assoc();
        if (password_verify($motDePasse, $utilisateur["userMdp"])) {
            header("Location: /projetphp/crud/index.php");
            exit();
        } else {
            $erreur = "Mot de passe incorrect";
        }
    } else {
        $erreur = "Nom d'utilisateur incorrect";
    }
}
?>

<!-- Formulaire de connexion -->

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="userMdp">Mot de passe :</label>
    <input type="password" id="userMdp" name="userMdp"><br><br>
    <input type="submit" value="Se connecter">
</form>

<?php
// Afficher les erreurs s'il y en a
if (isset($erreur)) {
    echo "<p>$erreur</p>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery-1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>

    <title>Connexion</title>
</head>
<body>

    

    <div class="container testcont justify-content-center border-secondary bg-body-secondary align-items-center   ">
    <?php if (!empty($$errorMDP)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $$errorMDP; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
 <div class="container rounded-3  my-5 p-5  bg-body-secondary   ">
    
        <form method="POST" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
          <h1 class="h3 mb-3 text-center fw-bold">Connexion Gestion Des clients</h1>
      
          <div class="form-floating">
            <input type="text" class="form-control my-1" name="username" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Entrer votre username</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="userMdp" placeholder="Password">
            <label for="floatingPassword">Entrer votre mot de passe</label>
          </div>
         
      
          <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Se souvenir de moi
            </label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
          <p class="mt-5 mb-3 text-center text-body-secondary">&copy; EasyResto </p>
       
      </main>
      <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      
 </div>
</div>
 

   
    
</body>
</html>