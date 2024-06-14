<?php
session_start();
// sécurité de connexion via SESSION dans l'administration 
if(!$_SESSION['login'])
{
    // redirection
    header("LOCATION:index.php");
}

// besoin d'id pour fonctionner
if(isset($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);
}else{
    header("LOCATION:products.php");
}

// vérifier si le produit existe bien dans la bdd
// en même temps on récup les données
require "../connexion.php";
$req = $bdd->prepare("SELECT * FROM stock WHERE id=?");
$req->execute([$id]);
$don = $req->fetch();
$req->closeCursor();
if(!$don)
{
    header("LOCATION:products.php");
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
        // je n'ai pas d'image donc modif sans gèrer l'image
        
        // j'ai une image donc modif avec image 

        

        // insertion a la base de données
       
        $update = $bdd->prepare("UPDATE stock SET title=:titre, date=:date, description=:description, image=:image WHERE id=:id");
        $update->execute([
            ":titre"=>$title,
            ":description" => $description,
            ":date"=>$date,
            ":image"=>$fichier,
            ":id" => $id
        ]);
        $update->closeCursor();
        header("LOCATION:products.php?update=".$id);
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:updateProduct.php?id=".$id."&error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}