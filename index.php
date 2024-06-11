<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $req = $bdd->query("SELECT id,title FROM stock");
        while($don = $req->fetch())
        {
            var_dump($don);
            echo "<div><a href='produit.php?id=".$don['id']."'>".$don['title']."</a></div>";
        }
        $req->closeCursor();
    ?>

    <form action="search.php" method="GET">
        <div class="form-group">
            <label for="search">Rechercher: </label>
            <input type="text" name="search" id="search">
        </div>
        <div class="form-group">
            <input type="submit" value="Rechercher">
        </div>
    </form>
</body>
</html>