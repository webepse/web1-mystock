<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Admin - Products - add</title>
</head>
<body>
    <?php
        include("partials/header.php");
    ?>
    <main>
        <div class="container">
            <h2>Ajouter un produit</h2>
            <?php
                if(isset($_GET['error']))
                {
                    echo "<div class='alert alert-danger'>Une erreur est survenue (code erreur: ".$_GET['error'].")</div>";
                }
            ?>
            <form action="treatmentAddProduct.php" method="POST" enctype="multipart/form-data">
                <div class="form-group my-3">
                    <label for="title">Titre: </label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group my-3">
                    <label for="date">Date: </label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group my-3">
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group my-3">
                    <label for="categorie">Catégorie: </label>
                    <select name="categorie" id="categorie" class="form-control">
                    <?php
                        require "../connexion.php";
                        $req = $bdd->query("SELECT * FROM categories");
                        while($don = $req->fetch())
                        {
                            echo "<option value='".$don['id']."'>".$don['nom']."</option>";
                        }
                        $req->closeCursor();
                    ?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="fichier">Fichier: </label>
                    <input type="file" name="fichier" id="fichier" class="form-control">
                </div>
                <div class="form-group my-3">
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>
    <?php
        include("partials/footer.php");
    ?>
  
</body>
</html>