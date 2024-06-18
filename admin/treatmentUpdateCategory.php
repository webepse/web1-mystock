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
        header("LOCATION:categories.php");
    }

    // vérifier si le produit existe bien dans la bdd
    // en même temps on récup les données
    require "../connexion.php";
    $req = $bdd->prepare("SELECT * FROM categories WHERE id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    $req->closeCursor();
    if(!$don)
    {
        header("LOCATION:categories.php");
    }

// savoir si je suis passé par formulaire ou non
if(isset($_POST['nom']))
{
    // tester les valeurs du formulaire
    // initialisation d'une variable erreur à 0
    $error = 0;
    // tester chaque valeur
    if(empty($_POST['nom']))
    {
        $error = 1;
    }else{
        $nom = htmlspecialchars($_POST['nom']);
    }

    // vérif s'il y a eu une erreur 
    if($error == 0)
    {
     
        require "../connexion.php";
        $update = $bdd->prepare("UPDATE categories SET nom=:nom WHERE id=:id");
        $update->execute([
            ":nom"=>$nom,
            ":id"=>$id
        ]);
        $update->closeCursor();
        header("LOCATION:categories.php?update=".$id);
              
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:updateCategory.php?id=".$id."&error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}