<?php 
    if(isset($_GET['search']))
    {
        $search = htmlspecialchars($_GET['search']);
    }else{
        $search="";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="search.php" method="GET">
        <div class="form-group">
            <label for="search">Rechercher: </label>
            <input type="text" name="search" id="search" value="<?= $search ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Rechercher">
        </div>
    </form>

    <?php
        if(isset($_GET['search']))
        {
            require "connexion.php";
            $req = $bdd->prepare("SELECT * FROM stock WHERE title LIKE :search OR description LIKE :search");
            $mySearch = "%".$search."%";
            $req->bindParam(":search",$mySearch, PDO::PARAM_STR);
            $req->execute();
            $count = $req->rowCount();
            if($count > 0)
            {
                while($don = $req->fetch())
                {
                    echo "<div><a href='produit.php?id=".$don['id']."'>".$don['title']."</a></div>";
                }
            }else{
                echo "<div>aucun résultat</div>";
            }
            $req->closeCursor();
        
        }

    ?>

</body>
</html>