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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Admin - Gestion des produits</title>
</head>
<body>
    <div class="container-fluid">
        <h1>Administration des produits</h1>
        <a href="dashboard.php" class="btn btn-secondary">Retour</a>
        <a href="addProduct.php" class="btn btn-primary mx-3">Ajouter un produit</a>
        <?php 
            if(isset($_GET['add']))
            {
                echo "<div class='alert alert-success my-3'>Votre produit a bien été ajoutée à la base de données</div>";
            }

        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require "../connexion.php";
                    $products = $bdd->query("SELECT * FROM products");
                    while($donProd = $products->fetch())
                    {
                        echo "<tr>";
                            echo "<td>".$donProd['id']."</td>";
                            echo "<td>".$donProd['title']."</td>";
                            echo "<td>".$donProd['price']."€</td>";
                            echo "<td>";
                                echo "<a href='#' class='btn btn-warning'>Modifier</a>";
                                echo "<a href='#' class='btn btn-danger mx-2'>Supprimer</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    $products->closeCursor();
                ?>
            </tbody>
        </table>
    </div>    
</body>
</html>