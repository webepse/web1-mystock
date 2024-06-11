<?php
session_start();
// sécurité de connexion via SESSION dans l'administration 
if(!$_SESSION['login'])
{
    // redirection
    header("LOCATION:index.php");
}

// savoir si je suis passé par formulaire ou non
if(isset($_POST['title']))
{
    // tester les valeurs du formulaire
    // initialisation d'une variable erreur à 0
    $error = 0;
    // tester chaque valeur
    if(empty($_POST['title']))
    {
        $error = 1;
    }else{
        $title = htmlspecialchars($_POST['title']);
    }

    if(empty($_POST['date']))
    {
        $error = 2;
    }else{
        $date = htmlspecialchars($_POST['date']);
    }

    if(empty($_POST['description']))
    {
        $error = 3;
    }else{
        $description= htmlspecialchars($_POST['description']);
    }

    if(empty($_POST['fichier']))
    {
        $error = 4;
    }else{
        $fichier = htmlspecialchars($_POST['fichier']);
    }

    // vérif s'il y a eu une erreur 
    if($error == 0)
    {
        // insertion a la base de données
        // connexion à la bdd
        require "../connexion.php";
        $insert = $bdd->prepare("INSERT INTO stock(title,date,description,image) VALUES(:titre,:date,:description,:image)");
        $insert->execute([
            ":titre"=>$title,
            ":description" => $description,
            ":date"=>$date,
            ":image"=>$fichier
        ]);
        $insert->closeCursor();
        header("LOCATION:products.php?add=success");
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:addProduct.php?error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}