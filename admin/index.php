<?php 
    session_start();

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    if(isset($_POST['username']))
    {
        if(!empty($_POST['username']) AND !empty($_POST['password']))
        {
            require "../connexion.php";
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];
            $reqConnex = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $reqConnex->execute([$username]);
            if($don=$reqConnex->fetch())
            {
                if(password_verify($password,$don['password']))
                {
                    $_SESSION['login']=$don["login"];
                    header("LOCATION:dashboard.php");
                }else{
                    $error = "Votre mot de passe ne correspond pas à votre username";
                }
            }else{
                $error = "Votre username n'est pas correct";
            }
        }else{
            $error = "Veuillez remplir correctement le formulaire";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Admin stock - connexion</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h1>Stock Connexion admnistration</h1>
                <form action="index.php" method="POST">
                    <?php
                        if(isset($error)){
                            echo "<div class='alert alert-danger'>".$error."</div>";
                        }
                    ?>
                    <div class="form-group my-3">
                        <label for="username">Login: </label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password">password: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <input type="submit" class="btn btn-primary" value="Connexion">
                        <a href="../index.php" class="btn btn-secondary mx-3">Retour au site</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>