<!DOCTYPE html>
<?php
include('fonctions/fonctions.php');
session_start();

if (isset($_POST['submit'])) {
    modifier_message();
}
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ modifier</title>
</head>

<body>

    <header>
        <div class="titre">
            <h1>AppFAQ</h1>
        </div>
        <div class="boite_deconnecter">
            <a href="confirmer_deconnection.php"><span>Se déconnecter</span></a>
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
        <div class="modif">
            <div class="entete">
                <h1>Modifier un message</h1>
            </div>

            <div class="boites_modif">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
                    <textarea id="question" name="question" rows="4" cols="50">Écrivez votre question ici !</textarea>
                    <textarea id="question" name="reponse" rows="4" cols="50">Écrivez votre réponse ici !</textarea>
                    <p><input type="submit" name="submit" value="Envoyer" /></p>
                </form>


    </div>
    </div>
    </div>
    <br><br><br>
    <?php footer(); ?>
</body>

</html>