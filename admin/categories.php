<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";


    if(isset($_GET['delete']))
    {
      

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
    <title>Admin - Categories</title>
</head>
<body>
    <?php
        include("partials/header.php");
    ?>
    <main>
        <div class="container">
            <h1>Gestion des catégories</h1>
            <a href="addCategory.php" class="btn btn-primary my-3">Ajouter un catégorie</a>
            <?php
                if(isset($_GET['add']))
                {
                    echo "<div class='alert alert-success'>Vous avez bien ajouté une catégorie à la base de données</div>";
                }
                if(isset($_GET['update']))
                {
                    echo "<div class='alert alert-warning'>Vous avez bien modifié la catégorie n°".$_GET['update']."</div>";
                }
                if(isset($_GET['deletesuccess']))
                {
                    echo "<div class='alert alert-danger'>Vous avez bien supprimé la catégorie n°".$_GET['deletesuccess']."</div>";
                }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nom</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $req = $bdd->query("SELECT * FROM categories");
                        while($don = $req->fetch())
                        {
                            echo "<tr>";
                                echo "<td>".$don['id']."</td>";
                                echo "<td>".$don['nom']."</td>";
                              
                                echo "<td class='text-center'>";
                                    echo "<a href='updateCategory.php?id=".$don['id']."' class='btn btn-warning'>Modifier</a>";
                                    echo "<a href='category.php?delete=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                        $req->closeCursor();
                    ?>
                    
                </tbody>
            </table>
        </div>
    </main>
    <?php
        include("partials/footer.php");
    ?>
  
</body>
</html>