<?php
// existance et numérique
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);   
}else{
    header("LOCATION:index.php");
}

// présence dans la bdd
require "connexion.php";
$req = $bdd->prepare("SELECT * FROM stock WHERE id=?");
$req->execute([$id]);
$don = $req->fetch();
$req->closeCursor();
if(!$don)
{
    header("LOCATION:index.php");
}



if(isset($_POST['author']))
{
    $err=0;
    if(empty($_POST['author']))
    {
        $err=1;
    }else{
        $author=htmlspecialchars($_POST['author']);
    }

    if(empty($_POST['message']))
    {
        $err=2;
    }else{
        $message=htmlspecialchars($_POST['message']);
    }

    if($err==0)
    {
        // insertion dans la base de données
        // req pour insert
        $insert = $bdd->prepare("INSERT INTO commentaires(author,date,content,id_stock) VALUES(:author,NOW(),:content,:id)");
        $insert->execute([
            ":author"=>$author,
            ":content"=>$message,
            ":id"=>$id
        ]);
        $insert->closeCursor();
        header("LOCATION:produit.php?id=".$id."&com=success");
    }else{
        header("LOCATION:produit.php?id=".$id."&error=".$err);
    }


}else{
    header("LOCATION:index.php");
}