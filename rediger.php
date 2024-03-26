<!DOCTYPE html>
<html lang="fr">
<?php
include('fonctions/fonctions.php');
session_start();
user_non_connecte();
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
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['mdp'])) {
            echo '<p><div class="user_connecte_info">Connecté en tant que <strong>' . $_SESSION['pseudo'] . '</strong></div></p>';
        }
        ?>
        <div class="boite_deconnecter">
            <a href="confirmer_deconnection.php"><span>Déconnexion</span></a>
        </div>
    </header>

    <div class="page">
        <div class="modif2">
            <div class="entete">
                <h1>Rédiger un message</h1>
            </div>
            <div class="boites_modif">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <textarea id="question" name="question" rows="4" cols="50" placeholder="Écrivez votre question ici !"></textarea>
                    <p><input type="submit" name="submit" value="Envoyer" /></p>
                </form>
            </div>
            <div class="b_modif">
            <a href="message.php"><span>Revenir en arrière</span></a>
        </div>
        </div>
        <br>

    </div>
    </div>
    <?php footer(); ?>
</body>

</html>