<?php 
    session_start();

    // sécurité de connexion
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // sécurité d'envoie de form
    if(isset($_POST['title']))
    {
        // éval des données avant insertion
        $err = 0;
        if(empty($_POST['title']))
        {
            $err=1;
        }else{
            $title = htmlspecialchars($_POST['title']);
        }

        if(empty($_POST['description']))
        {
            $err=2;
        }else{
            $description= htmlspecialchars($_POST['description']);
        }

        if(empty($_POST['date']))
        {
            $err=3;
        }else{
            $date = htmlspecialchars($_POST['date']);
        }

        if(empty($_POST['price']))
        {
            $err=4;
        }else{
            $price = htmlspecialchars($_POST['price']);
        }

        // test si err 
        if($err == 0)
        {
            // traitement
            require "../connexion.php";
            $insert = $bdd->prepare("INSERT INTO products(title,description,date,price) VALUES(:titre,:descri,:date,:prix)");
            $insert->execute([
                ":titre" => $title,
                ":descri" => $description,
                ":date" => $date,
                ":prix" => $price
            ]);
            $insert->closeCursor();
            header("LOCATION:products.php?add=success");

        }else{
            header("LOCATION:addProduct.php?error=".$err);
        }

    }else{
        // redirection 
        header("LOCATION:addProduct.php");
    }



?>