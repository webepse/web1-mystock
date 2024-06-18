<?php
session_start();
// sécurité de connexion via SESSION dans l'administration 
if(!$_SESSION['login'])
{
    // redirection
    header("LOCATION:index.php");
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
        $insert = $bdd->prepare("INSERT INTO categories(nom) VALUES(:nom)");
        $insert->execute([
            ":nom"=>$nom,
        ]);
        $insert->closeCursor();
        header("LOCATION:categories.php?add=success");
              
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:addCategory.php?error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}