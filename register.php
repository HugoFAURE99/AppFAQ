<?php
    include "fonctions/fonctions.php";
    session_start();
    if (isset($_SESSION['pseudo'])){
        header("Location: index.php");
        exit();
    }
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

                <?php

                    $submit = isset($_POST["submit"]);

                    if($submit){
                        db_add_user();

                        if($_GET['user_cree']==true){

                            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
                            $_SESSION['pseudo']=$pseudo;

                            echo "<p class='message_validation'> Session de : ".$_SESSION['pseudo']."</p>";
                        }
                    }
                ?>


                <div class="zone_formulaire">


                    <div class="boite_input">
                        <input type="text" name="pseudo" required="required">
                        <span>Pseudo</span required="required">
                    </div>

                    <div class="boite_input">
                        <input type="email" name="mail" required="required">
                        <span>Identifiant/EMail</span required="required">
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
                        
                        
                        
                        <?php

                            $dbh = db_connect();

                            //RECUPERATION DES LIBELLES DES LIGUES ET AFFICHAGE EN DROP DOWN LIST
                                $sql_lib_ligue = "select lib_ligue, ligue.id_ligue from ligue";
                                $i = 0;

                                try {
                                    $sth = $dbh->prepare($sql_lib_ligue);
                                    $sth->execute();
                                    $lib_ligue_bdd = $sth->fetchAll(PDO::FETCH_ASSOC);
                                    } catch (PDOException $ex) {
                                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                                    }

                                foreach ($lib_ligue_bdd as $row){

                                        if($row['id_ligue'] != 4){
                                            echo '<option value="'.$row['id_ligue'].'">'.$row['lib_ligue'].'</option>';
                                        }
                                    $i++;
                                    
                                }

                                echo '<option value="'.($i).'" selected="selected">Choisir une ligue...</option>';
                                $_GET['i_value']=$i;
                            ?>

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
    <?php footer(); ?>
</body>
</html>



