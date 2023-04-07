<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>test</h2>

    <?php
        $req = $bdd->query("SELECT * FROM products");
        while($don = $req->fetch())
        {
            echo "<div><a href='product.php?id=".$don['id']."'>".$don['title']."</a></div>";
        }
        $req->closeCursor();


    ?>
</body>
</html>