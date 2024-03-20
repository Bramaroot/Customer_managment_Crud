<?php
$name = "";
$email = "";
$phone = "";
$address = "";
$nomServer = "localhost";
$root = "root";
$mdp = "";
$database = "products";


// Connexion à la base de données
$connexion = new mysqli($nomServer, $root, $mdp, $database);

$messageSuccess = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];  

    // Vérification des champs requis
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $errorMessage = "Tous les champs sont requis pour soumettre le formulaire";
    } else {
        // Insertion du nouveau client dans la base de données
        $newClient = "INSERT INTO CLIENTs (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        $resultAdd = $connexion->query($newClient);

        if (!$resultAdd) {
            $errorMessage = "Requête invalide: " . $connexion->error;
        } else {
            $messageSuccess = "Nouveau client ajouté à la base de données";
            // Réinitialisation des valeurs des champs après l'insertion
            $name = "";
            $email = "";
            $phone = "";
            $address = "";
            // Redirection vers la page d'accueil après l'ajout réussi
            header("Location: /projetphp/crud/index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau client</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery-1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <div class="container my-4">
        <h2>Ajouter un nouveau client</h2>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="">Nom</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="">Email</label>
                <div class="col-sm-6">
                    <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="">Numero de telephone</label>
                <div class="col-sm-6">
                    <input class="form-control" type="number" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="">Adresse</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php if (!empty($messageSuccess)) : ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $messageSuccess; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/projetphp/crud/index.php" role="button" class="btn btn-outline-primary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
