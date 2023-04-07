<?php
    require "connexion.php";

    $id = htmlspecialchars($_GET['id']);

    $req = $bdd->prepare("SELECT title, DATE_FORMAT(date, '%d/%m/%Y') as mydate,description,price FROM products WHERE id=?");
    $req->execute([$id]);
    $don=$req->fetch();

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
    <h1> <?php echo $don['title']; ?> </h1>
    <h1><?= $don['title'] ?></h1>
    <h4><?= $don['mydate'] ?></h4>
    <div><?= nl2br($don['description']) ?></div>
    <div><?= $don['price'] ?>€</div>
</body>
</html>