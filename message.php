<?php 


include('fonctions/fonctions.php');
session_start();
liste_messages_ligue(); 

$dbh = db_connect();
$sql = 'select PQ.pseudo AS PseudoQ, faq.question, PR.pseudo AS PseudoR, faq.reponse
from faq, user PQ, user PR
where PQ.id_user = faq.id_user_question
    AND PR.id_user = faq.id_user_reponse
    AND faq.id_ligue = :id_ligue
order by dat_question desc;';
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array( ":id_ligue" => $_SESSION['id_ligue']));
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

?>
<!DOCTYPE html>
<html lang="fr">
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
    <table>

        <th>Utilisateur(s)</th>
        <th>Question(s)</th>
        <th>Admin(s)</th>
        <th>Réponse(s)</th>
        <!--ajouter conditions admin ou non -->
        <?php
            if($_SESSION['id_usertype'] == 1 || $_SESSION['id_usertype'] == 2 ){

           echo '<th>Fonction(s)</th>';

            } 
        ?>
        <?php
            if (count($rows)>0) {
                
                foreach ($rows as $row)
                {
                echo '<tr>';
                echo '<td class="td_pseudo">'.$row['PseudoQ'].'</td>';
                echo '<td>'.$row['question'].'</td>';
                echo '<td class="td_pseudo">'.$row['PseudoR'].'</td>';
                echo '<td>'.$row['reponse'].'</td>';

                if($_SESSION['id_usertype'] == 1 || $_SESSION['id_usertype'] == 2 ){
                echo '<td><a href="modifier.php" class="boutons_tab_fonction" id="boutons_tab_fonction_1">Modifier</a> <a href="confirmer_suppression.php" class="boutons_tab_fonction" id="boutons_tab_fonction_2">Supprimer</a></td>';
                echo "</tr>";
                } 
                }
            
            } else {
            echo "<p>Rien à afficher</p>";
            }

        ?>

    </table>
    
    </div>

    <br>

    <footer>
        <p>BTS SIO &copy;2024 APPFAQ<br>Samuel KAKEZ, Hugo FAURE, Sylvain FACCIN</p>
    </footer>
</body>

</html>