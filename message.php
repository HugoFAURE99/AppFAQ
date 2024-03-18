<!DOCTYPE html>
<html lang="fr">
<!--c samsam je bosse sur ca-->

<?php
include('fonctions/fonctions.php');
session_start();
liste_messages_ligue(); 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ - massages</title>
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
            <a href="confirmer_deconnection.php"><span>Se déconnecter</span></a>
        </div>
        <div class="boite_rediger">
            <a href="rediger.php"><span>Rédiger un message</span></a>
        </div>
    </header>
    <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['mdp'])) {
            echo '<p><div class="ligue_connecte_info">Derniers messages de la <strong>' . $_SESSION['lib_ligue'] . '.</strong></div></p>';
        }
        ?>
    <div class="page_accueil">
        <div class="boite_module">
            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_question_0'];?> a demandé</p1>
            </div>

            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_question_0'];?></p1>
            </div>

            <div class="img_fleche">
                <img class="img_fleche" src="Images/fleche-vers-le-bas.png" alt="fleche" />
            </div>


            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_reponse_0'];?> a répondu</p1>
            </div>


            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_reponse_0'];?></p1>
            </div>

            <div class="boite_modifier">
                <a href="modifier.php"><span>modifier</span></a>
            </div>
        </div>

        <div class="boite_module">
            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_question_1'];?> a demandé</p1>
            </div>

            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_question_1'];?></p1>
            </div>

            <div class="img_fleche">
                <img class="img_fleche" src="Images/fleche-vers-le-bas.png" alt="fleche" />
            </div>


            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_reponse_1'];?> a répondu</p1>
            </div>


            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_reponse_1'];?></p1>
            </div>

            <div class="boite_modifier">
                <a href="modifier.php"><span>modifier</span></a>
            </div>
        </div>
        
        
        <div class="boite_module">
            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_question_2'];?> a demandé</p1>
            </div>

            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_question_2'];?></p1>
            </div>

            <div class="img_fleche">
                <img class="img_fleche" src="Images/fleche-vers-le-bas.png" alt="fleche" />
            </div>


            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_reponse_2'];?> a répondu</p1>
            </div>


            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_reponse_2'];?></p1>
            </div>

            <div class="boite_modifier">
                <a href="modifier.php"><span>modifier</span></a>
            </div>
        </div>

        <div class="boite_module">
            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_question_3'];?> a demandé</p1>
            </div>

            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_question_3'];?></p1>
            </div>

            <div class="img_fleche">
                <img class="img_fleche" src="Images/fleche-vers-le-bas.png" alt="fleche" />
            </div>


            <div class="nom_utilisateur_publication">
                <p1><?php echo $_SESSION['pseudo_reponse_3'];?> a répondu</p1>
            </div>


            <div class="boite_module_mini">
                <p1><?php echo $_SESSION['texte_reponse_3'];?></p1>
            </div>

            <div class="boite_modifier">
                <a href="modifier.php"><span>modifier</span></a>
            </div>
        </div>
    </div>

    <br>

    <footer>
        <p>BTS SIO &copy;2024 APPFAQ<br>Samuel KAKEZ, Hugo FAURE, Sylvain FACCIN</p>
    </footer>
</body>

</html>