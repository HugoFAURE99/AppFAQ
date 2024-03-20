<!DOCTYPE html>
<html lang="fr">
<?php
include('fonctions/fonctions.php');
session_start();

if (isset($_POST['submit'])) {
    ajouter_message();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ rediger</title>
</head>

<body>

    <header>
        <div class="titre">
            <h1>AppFAQ</h1>
        </div>
        <div class="boite_deconnecter">
            <a href="confirmer_deconnection.php"><span>Se déconnecter</span></a>
        </div>
    </header>

    <div class="page">
        <div class="modif2">
            <div class="entete">
                <h1>Rédiger un message</h1>
            </div>

            <div class="boites_modif">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
                    <textarea id="question" name="question" rows="4" cols="50">Écrivez votre question ici !</textarea>
                    <p><input type="submit" name="submit" value="Envoyer" /></p>
                </form>

            </div>
            <br>
            <div class="b_modif">
                <a href="message.php"><span>Revenir en arrière</span></a>
            </div>
        </div>

       <?php footer(); ?>
</body>

</html>