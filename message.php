<?php
include('fonctions/fonctions.php');
session_start();
user_non_connecte();
$dbh = db_connect();

$session_user_admin = ($_SESSION['id_usertype'] == 0 || $_SESSION['id_usertype'] == 1);

$session_admin_super_admin = ($_SESSION['id_usertype'] == 1 || $_SESSION['id_usertype'] == 2);

$session_super_admin = ($_SESSION['id_usertype'] == 2);


$sql_faq_ligue_user = 'select PQ.pseudo AS PseudoQ, faq.question, PR.pseudo AS PseudoR, faq.reponse, faq.id_faq
from faq, user PQ, user PR
where PQ.id_user = faq.id_user_question
AND PR.id_user = faq.id_user_reponse
AND faq.id_ligue = :id_ligue
order by dat_question desc;';

$sql_faq_toutes_ligues = 'select PQ.pseudo AS PseudoQ, faq.question, PR.pseudo AS PseudoR, faq.reponse, faq.id_faq, ligue.lib_ligue
from faq, user PQ, user PR, ligue
where PQ.id_user = faq.id_user_question
AND PR.id_user = faq.id_user_reponse
AND ligue.id_ligue = PQ.id_ligue
order by faq.id_ligue, faq.dat_reponse;';

try {
    if ($session_user_admin) {
        $sth = $dbh->prepare($sql_faq_ligue_user);
        $sth->execute(array(":id_ligue" => $_SESSION['id_ligue']));
    } else if ($session_super_admin) {
        $sth = $dbh->prepare($sql_faq_toutes_ligues);
        $sth->execute();
    }
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
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
            <a href="confirmer_deconnection.php"><span>Déconnexion</span></a>
        </div>
    </header>
    <?php affichage_message_statut(); ?>
    <?php
    if (isset($_SESSION['pseudo']) && isset($_SESSION['mdp'])) {
        if ($session_user_admin) {
            echo '<p><div class="ligue_connecte_info">Derniers messages de la <strong>' . $_SESSION['lib_ligue'] . '.</strong></div></p>';
        } else if ($session_super_admin) {
            echo '<p><div class="ligue_connecte_info">Derniers messages de <strong>Toutes Ligues confondues.</strong></div></p>';
        }
    }
    ?>

    <div class="page_accueil">
        <div class="boite_rediger">
            <a href="rediger.php">Rédiger un message</a>
        </div>
        <table class="table_message_">
            <tr>
                <?php if ($session_super_admin) {
                    echo '<th>Ligue</th>';
                } ?>
                <th>Utilisateur(s)</th>
                <th>Question(s)</th>
                <th>Admin(s)</th>
                <th>Réponse(s)</th>
                <?php
                if ($session_admin_super_admin) {
                    echo '<th>Action(s)</th>';
                }
                ?>
            </tr>
            <?php
            if (count($rows) > 0) {
                foreach ($rows as $row) {
                    echo '<tr>';
                    if ($session_super_admin) {
                        echo '<td>' . $row['lib_ligue'] . '</td>';
                    }
                    echo '<td class="td_pseudo">' . $row['PseudoQ'] . '</td>';
                    echo '<td>' . $row['question'] . '</td>';
                    echo '<td class="td_pseudo">' . $row['PseudoR'] . '</td>';
                    echo '<td>' . $row['reponse'] . '</td>';
                    if ($session_admin_super_admin) {
                        echo '<td><a href="modifier.php?id_faq=' . $row['id_faq'] . '"class="boutons_tab_fonction" id="boutons_tab_fonction_1">Modifier</a> <a href="confirmer_suppression.php?id_faq=' . $row['id_faq'] . '" class="boutons_tab_fonction" id="boutons_tab_fonction_2">Supprimer</a></td>';
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
    <?php footer(); ?>
</body>

</html>