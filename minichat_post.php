<?php 

    require_once "config.php";
    //CONNEXION A MA BASE DE DONNEES
    try 
    {
        $bd = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD, 
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING 
           )
        );
    }
    catch (PDOException $e) 
    {
        die($e->getMessage());
    }

    //Insertion des donnees dans la base
    $requete = $bd->prepare('INSERT INTO minichat(pseudo,message) VALUES(:pseudo, :message)')  or die(print_r($bd->errorInfo()));
    $requete->execute(array(
        'pseudo' => $_POST['pseudo'],
        'message' => $_POST['message']
    ));
    //Redirection vers le formulaire
    header('Location: minichat.php');

?>