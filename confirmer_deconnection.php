<?php
    include "fonctions/fonctions.php";
session_start();
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
    </header>

    <div class="page">
        <div class="modif">
            <div class="entete">
                <h1>Êtes-vous sûr ?</h1>
            </div>


            <br>
            <div class="b_modif">
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
    <footer>
        <p>BTS SIO &copy;2024 APPFAQ<br>Samuel KAKEZ, Hugo FAURE, Sylvain FACCIN</p>
    </footer>

<?php
    // Check si "Valider" est cliquer
    if (isset($_POST['valider'])) {
        deconnexion();
    }
?>
</body>

</html>