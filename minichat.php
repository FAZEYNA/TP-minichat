<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minichat</title>
    <link rel="stylesheet" href="/COURS/OC/minichat/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container mt-5">
        <form method="POST" action="minichat_post.php">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Renseigner votre pseudo :</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Votre message :</label>
                <input type="text" class="form-control" id="message" name="message" placeholder="">
            </div>
            <div class="mt-5 w-25">
                <input type="submit" class="form-control btn-outline-primary shadow-none" id="envoyer" name="envoyer" value="Envoyer" placeholder="">
            </div>
        </form>
    </div>
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
        //Requete qui selectionne le pseudo et message des 10 dernieres personnes
        $requete = $bd->query('SELECT pseudo,message FROM minichat ORDER BY ID DESC LIMIT 10') or die(print_r($bd->errorInfo()));
        // AFFICHAGE
        echo '<div class="container mt-5 bg-light">';
            while($donnees = $requete->fetch())
            {
                echo '<p>Pseudo : '.$donnees['pseudo'].' - Message : '.$donnees['message'].'</p>';
            }
        echo '</div>';
    ?>
</body>
</html>