

-------------------------------------------------------------------------------------------------
<?php

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$messageSuccess = "";
$errorMessage = "";
$nomServer = "localhost";
$root = "root";
$mdp = "";
$database = "products";

// Connexion à la base de données
$connexion = new mysqli($nomServer, $root, $mdp, $database);

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    // IF IT'S GET, DISPLAY THE CLIENT'S DETAILS

    // If the id doesn't exist, redirect to index.php to select an id by clicking on a client
    if (!isset($_GET["id"])) {
        header("Location: /projetphp/crud/index.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the selected client's row
    // Prepare the query
    $rSql = "SELECT * FROM CLIENTS WHERE ID =$id";
    $resultRsql = $connexion->query($rSql);
    $ligneTrouve = $resultRsql->fetch_assoc();

    if (!$ligneTrouve) {
        header("Location: /projetphp/crud/index.php");
        exit;
    }

    $name = $ligneTrouve["name"];
    $email = $ligneTrouve["email"];
    $phone = $ligneTrouve["phone"];
    $address = $ligneTrouve["address"];
} else {
    // POST MODIFIES THE CLIENT'S INFO

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All fields are required to submit the form";
            break;
        }

        $modifRequete = "UPDATE CLIENTS SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";

        $resultModif = $connexion->query($modifRequete);

        if (!$resultModif) {
            $errorMessage = "Invalid request: " . $connexion->error;
            break;
        }

        $messageSuccess = "Client information updated successfully";
        header("Location: /projetphp/crud/index.php");
        exit;

    } while (false);
}
?>



------------------------------------------------------------------------------







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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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
