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


    // vérif s'il y a eu une erreur 
    if($error == 0)
    {
        // gestion fichier
        if($_FILES['fichier']['error']==0)
        {
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
                      // insertion a la base de données
                        // connexion à la bdd
                        require "../connexion.php";
                        $insert = $bdd->prepare("INSERT INTO stock(title,date,description,image) VALUES(:titre,:date,:description,:image)");
                        $insert->execute([
                            ":titre"=>$title,
                            ":description" => $description,
                            ":date"=>$date,
                            ":image"=>$fichiercpt
                        ]);
                        $insert->closeCursor();
                        header("LOCATION:products.php?add=success");
                }else{
                    header("LOCATION:addProduct.php?errorimg=7");
                }
            }else{
                header("LOCATION:addProduct.php?errorimg=".$imgError);
            }

        }else{
            header("LOCATION:addProduct.php?errorimg=".$_FILES['fichier']['error']);
        }


      
    }else{
        // redirige vers le formulaire en donnant en GET l'erreur (indicatif)
        header("LOCATION:addProduct.php?error=".$error);
    }


}else{
    // pas de formulaire
    header("LOCATION:index.php");
}