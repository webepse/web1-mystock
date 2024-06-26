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
// require "../connexion.php";
require_once '../connexion.php'; // s'assure que je le fais qu'une fois
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

    if(empty($_POST['categorie']))
    {
        $error = 4;
    }else{
        $categorie = htmlspecialchars($_POST['categorie']);
        $categories = ["1","2","3","4"];
        if(!in_array($categorie, $categories))
        {
            $error = 5;
        }

    }


    // vérif s'il y a eu une erreur 
    if($error == 0)
    {
        // je n'ai pas d'image donc modif sans gèrer l'image
        
        if($_FILES['fichier']['error']==4)
        {
            $update = $bdd->prepare("UPDATE stock SET title=:titre, date=:date, description=:description, categorie=:cat WHERE id=:id");
            $update->execute([
                ":titre"=>$title,
                ":description" => $description,
                ":date"=>$date,
                ":cat" => $categorie,
                ":id" => $id
            ]);
            $update->closeCursor();
            header("LOCATION:products.php?update=".$id);
        }else
        {
            // j'ai une image donc modif avec image 
            // traitement du fichier
            $dossier = "../images/"; // images/monfichier.jpg => imagesmonfichier.jpg
            $fichier = basename($_FILES['fichier']['name']); 
            $tailleMaxi = 2000000;
            $taille = filesize($_FILES['fichier']['tmp_name']);
            $extensions = ['.png','.gif','.jpg','.jpeg','.svg'];
            $extension = strrchr($_FILES['fichier']['name'],'.');

            if(!in_array($extension,$extensions))
            {
                $imgError = 5;
            }

            if($taille > $tailleMaxi)
            {
                $imgError = 6;
            }

            if(!isset($imgError))
            {
               
                $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); // preg_replace remplace tout ce qui n'est pas un KK normal en tiret

                // gestion de conflit 
                $fichiercpt = rand().$fichier;

                // déplacer le fichier
                if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.$fichiercpt))
                {
                    unlink("../images/".$don['image']);
                      // insertion a la base de données
                        // connexion à la bdd
                        $update = $bdd->prepare("UPDATE stock SET title=:titre, date=:date, description=:description, image=:image WHERE id=:id");
                        $update->execute([
                            ":titre"=>$title,
                            ":description" => $description,
                            ":date"=>$date,
                            ":image"=> $fichiercpt,
                            ":id" => $id
                        ]);
                        $update->closeCursor();
                        header("LOCATION:products.php?update=".$id);
                }else{
                    header("LOCATION:updateProduct.php?id=".$id."&errorimg=7");
                }
            }else{
                header("LOCATION:updateProduct.php?id=".$id."&errorimg=".$imgError);
            }


        }

        

        // insertion a la base de données
       
        // $update = $bdd->prepare("UPDATE stock SET title=:titre, date=:date, description=:description, image=:image WHERE id=:id");
        // $update->execute([
        //     ":titre"=>$title,
        //     ":description" => $description,
        //     ":date"=>$date,
        //     ":image"=>$fichier,
        //     ":id" => $id
        // ]);
        // $update->closeCursor();
        // header("LOCATION:products.php?update=".$id);
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:updateProduct.php?id=".$id."&error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}