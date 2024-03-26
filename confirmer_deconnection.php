<?php
    include "fonctions/fonctions.php";
session_start();
user_non_connecte();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ confirmer deconnexion</title>
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
    </header>

    <div class="page">
        <div class="modif">
            <div class="entete">
                <h1>Êtes-vous sûr ?</h1>
            </div>

            <br>

            <div>
                <form action="" method="post">
                    <button type="submit" name="valider"><span>Valider</span></button>
                </form>
            </div>

            <br>

            <div class="b_modif"> <!--  "Annuler" utilise $_SERVER['HTTP_REFERER'] comme URL -->
    <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php'; ?>"><span>Annuler</span></a>
</div>
            <br>
    </div></div>
    <?php footer(); ?>

<?php
    // Check si "Valider" est cliquer
    if (isset($_POST['valider'])) {
        deconnexion();
    }
?>
</body>

</html>