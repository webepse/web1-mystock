<?php
    if(isset($_GET['id']))
    {
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }
    require "connexion.php";

    $req = $bdd->prepare("SELECT id, title, description,image, DATE_FORMAT(date,'%d/%m/%Y') as mydate FROM stock WHERE id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    // var_dump($don);
    $req->closeCursor();
    if(!$don)
    {
        header("LOCATION:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice BASE 1 - <?= $don['title'] ?></title>
</head>
<body>
    <h1><?= $don['title'] ?></h1>
    <img src="images/<?= $don['image'] ?>" alt="image de <?= $don['title'] ?>">
    <h2><?= $don['mydate'] ?></h2>
    <div>
        <?= nl2br($don['description']) ?>
    </div>
    <h1>Commentaires</h1>
    <?php
        $com = $bdd->prepare("SELECT * FROM commentaires WHERE id_stock=?");
        $com->execute([$id]);
        $count = $com->rowCount();
        if($count > 0)
        {
            while($donCom = $com->fetch())
            {
                echo "<div>";
                    echo "<div>".$donCom['author']."</div>";
                    echo "<div>".$donCom['date']."</div>";
                    echo "<div>".$donCom['content']."</div>";
                echo "</div>";
            }
        }else{
            echo "Pas encore de commentaire sur cet article";
        }
        $com->closeCursor();
    ?>
    <?php
        if(isset($_GET['error']))
        {
            echo "<div class='alert'>Une erreur est survenue (code erreur: ".$_GET['error']." )</div>";
        }
        if(isset($_GET['com']))
        {
            echo "<div class='success'>Merci pour votre commentaire</div>";
        }
    ?>

    <form action="traitement.php?id=<?= $don['id'] ?>" method="POST">
        <input type="hidden" name="id" value="<?= $don['id'] ?>">
        <div class="form-group">
            <label for="author">Auteur: </label>
            <input type="text" name="author" id="author">
        </div>
        <div class="form-group">
            <label for="message">Commentaire: </label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>