<?php 
include('fonctions/fonctions.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ accueil</title>
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
                <h1>Accueil</h1>
            </div>
            <br>
            <div class="b_modif">
                <a href="login.php"><span>Se connecter</span></a>
            </div>
            <br>
            <div class="b_modif">
                <a href="register.php"><span>Créer un compte</span></a>
            </div>
            <br>
        </div>
    </div>

    <?php footer(); ?>
</body>

</html>