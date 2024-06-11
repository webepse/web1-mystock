<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    // besoin d'id pour fonctionner
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:products.php");
    }

    // vérifier si le produit existe bien dans la bdd
    // en même temps on récup les données
    require "../connexion.php";
    $req = $bdd->prepare("SELECT * FROM stock WHERE id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    $req->closeCursor();
    if(!$don)
    {
        header("LOCATION:products.php");
    }
    // if(!$don = $req->fetch())
    // {
    //     $req->closeCursor();
    //     header("LOCATION:products.php");
    // }
    // $req->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Admin - Products - upadte</title>
</head>
<body>
    <?php
        include("partials/header.php");
    ?>
    <main>
        <div class="container">
            <h2>Modifier un produit</h2>
            <?php
                if(isset($_GET['error']))
                {
                    echo "<div class='alert alert-danger'>Une erreur est survenue (code erreur: ".$_GET['error'].")</div>";
                }
            ?>
            <form action="treatmentUpdateProduct.php?id=<?= $id ?>" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group my-3">
                    <label for="title">Titre: </label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $don['title'] ?>" required>
                </div>
                <div class="form-group my-3">
                    <label for="date">Date: </label>
                    <input type="date" name="date" id="date" value="<?= $don['date'] ?>" class="form-control">
                </div>
                <div class="form-group my-3">
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" class="form-control"><?= $don['description'] ?></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="fichier">Fichier: </label>
                    <input type="text" name="fichier" id="fichier" value="<?= $don['image'] ?>" class="form-control">
                </div>
                <div class="form-group my-3">
                    <input type="submit" value="Modifier" class="btn btn-warning">
                    <a href="products.php" class="btn btn-secondary mx-2">Retour</a>
                </div>
            </form>
        </div>
    </main>
    <?php
        include("partials/footer.php");
    ?>
  
</body>
</html>