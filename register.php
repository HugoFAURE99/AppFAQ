<?php
    include "fonctions/fonctions.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ register</title>
</head>
<body>
    
    <header>
        <div class="titre">
            <h1>AppFAQ</h1>
        </div>

        <div class="boite_deja_compte">
            <div class="deja_compte">
                <div class="boite_par_ici">
                    <span>Déjà un compte ? C'est par <a href="login.php">ici</a> !</span>

                </div>
            </div>
        </div>
    </header>

    <div class="page">


        <div class="login">
            <div class="entete">
                <h1>Créer un compte</h1>
            </div>

            <form action="<?php $_SERVER ["PHP_SELF"] ?>" method="POST">
                <div class="zone_formulaire">


                    <div class="boite_input">
                        <input type="text" name="pseudo" required="required">
                        <span>Pseudo</span required="required">
                    </div>

                    <div class="boite_input">
                        <input type="email" name="mail" required="required">
                        <span>Identifiant</span required="required">
                    </div>

                    <div class="boite_input">
                        <input type="password" name="mdp" required="required">
                        <span>Mot de passe</span>
                    </div>

                    <div class="boite_input">
                        <input type="password" name="mdp_check" required="required">
                        <span>Veuillez le confirmer</span>
                    </div>

                    <div class="boite_input">
                        <select name="id_ligue" id="choix_ligue" required="required">
                            <option value="0" selected="selected">Football</option>
                            <option value="1">Basketball</option>
                            <option value="2">Volleyball</option>
                            <option value="3">Handball</option>
                        </select>
                    </div>

                    <div class="boite_submit">
                        <a href="message.php"><input type="submit" name="submit" required="required" id="envoyer"></a>
                    </div>
                </div>
            </form>    
        </div>

        
    </div>
    <br><br>
    <footer>
        <p>BTS SIO &copy;2024 APPFAQ<br>Samuel KAKEZ, Hugo FAURE, Sylvain FACCIN</p>
    </footer>

    <?php

    

    $submit = isset($_POST["submit"]);

    if($submit){

        db_add_user();
    }


    ?>
</body>
</html>
