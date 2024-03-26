<!DOCTYPE html>
<?php
include('fonctions/fonctions.php');
session_start();
admin_check();
user_non_connecte();
affichage_modification_messages();
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
                <form action="<?php echo $_SERVER['PHP_SELF'].'?id_faq='.$_GET["id_faq"]; ?>" method="post">
                    <label for="name">Question&nbsp;:</label>
                    <textarea id="question" name="question" rows="4" cols="50"><?php echo $_SESSION['question_modifier']; ?></textarea>
                    <label for="name">Réponse&nbsp;:</label>
                    <textarea id="question" name="reponse" rows="4" cols="50"><?php echo $_SESSION['reponse_modifier']; ?></textarea>
                    <p><input type="submit" name="submit" value="Envoyer" /></p>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
    <?php footer(); ?>
</body>

</html>