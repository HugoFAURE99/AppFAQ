<?php
include "fonctions/fonctions.php";
    session_start();
  
/*if (isset($_SESSION['pseudo'])){

    if (isset($_SESSION['mdp'])){
        //si l'utilisateur est connecté (session pseudo et mdp actives)
        header('Location: message.php');
    }
    else{
        //hugo fo que tu gères ca 
        echo "<p> Veuillez saisir vos identifiants !";
    }
}
*/
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ login</title>
</head>

<body>

    <header>
        <div class="titre">
            <h1>AppFAQ</h1>
        </div>
    </header>

    <div class="page">
        <div class="login">
            <div class="entete">
                <h1>Connectez-vous</h1>
            </div>

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="zone_formulaire">

                    <div class="boite_input">
                        <input type="text" name="pseudo" required="required">
                        <span>Identifiant / EMail</span required="required">
                    </div>

                    <div class="boite_input">
                        <input type="password" name="mdp" required="required">
                        <span>Mot de passe</span>
                    </div>

                    <div>
                        <a href="message.php"><input type="submit" name="submit" required="required" id="envoyer"></a>
                    </div>
                </div>
            </form>
            <br>
            <?php
            $submit = isset($_POST["submit"]);
            if ($submit) {
                userLogin();
            }
            ?>

        </div>

        <div class="sous_login">
            <div class="boite_par_ici">
                <span>Pas de compte ? Créez le <a href="register.php">ici</a> !</span>
            </div>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>