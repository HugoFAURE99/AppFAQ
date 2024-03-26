<?php
session_start();
include("fonctions/fonctions.php");
admin_check();
user_non_connecte();
supprimer_message();
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ confirmer suppression
    </title>
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
                <h1>Êtes-vous sûr ?</h1>
            </div>

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method=POST>
                <br>
                <div class="b_modif">
                    <input type="submit" name="submit_suppr">
                </div>
                <br>
                <div class="b_modif">
                    <a href="message.php"><span>Annuler</span></a>
                </div>
                <br>
            </form>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>