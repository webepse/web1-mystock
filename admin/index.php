<?php
    session_start();

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    // vérifier si formulaire envoyé
    if(isset($_POST['login']))
    {
        // vérifier si formulaire correctement envoyé
        if(empty($_POST['login']) || empty($_POST['password']))
        {
            $error = "Veuillez remplir correctement le formulaire";
        }else{
            // traitement
            require "../connexion.php";
            $login = htmlspecialchars($_POST['login']);
            $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                // je sais que ça existe
                if(password_verify($_POST['password'],$don['password']))
                {
                    // session
                    $_SESSION['login'] = $don['login'];
                    header("LOCATION:dashboard.php");
                }else{
                    $error = "Votre login ou votre mot de passe n'est pas correct";
                }
            }else{
                // login n'existe pas
                $error = "Votre login ou votre mot de passe n'est pas correct";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Administration</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h1>Connexion</h1>
                <form action="index.php" method="POST">
                    <?php
                        if(isset($error))
                        {
                            echo "<div class='alert alert-danger'>".$error."</div>";
                        }
                    ?>
                    <div class="form-group my-2">
                        <label for="login">Login: </label>
                        <input type="text" name="login" id="login" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" value="Connexion" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>