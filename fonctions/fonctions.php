<?php
//
// 
//
//
/**
 * Connexion à la base de données
 *
 * @return PDO objet de connexion
 */
function db_connect() {
  $dsn = 'mysql:host=localhost;dbname=appfaq';  // contient le nom du serveur et de la base
  $user = 'root';
  $password = '';
  try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
  }
  return $dbh;
}

//FONCTION QUI PERMET D'AJOUTER UN USER DANS LA BDD A L'AIDE DES SAISIES DU FORM REGISTER
function db_add_user() {

    $user_cree=false;

    //CONNECTION A LA BDD
    $dbh = db_connect();

    //CREATION DES VARIABLES QUI CONTIENNENT LES DONNEES SAISIES DANS LE FORM
    $id_user = "NULL";
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : "";
    $mdp_check = isset($_POST['mdp_check']) ? $_POST['mdp_check'] : "";
    $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    $id_usertype = "0";
    $id_ligue = isset($_POST['id_ligue']) ? $_POST['id_ligue'] : "0";

    //REQUETES QUI CONTIENT LA REQUETES SQL D'INSERTION DE L'USER
    $sql="insert into user values (:id_user,:pseudo,:mdp,:mail,:id_usertype,:id_ligue)";

    //Check que le MDP et la CONFIRAMTION CORRESPONDENT
      //SI NON ALORS AFFICHER ERREUR
      if ($mdp != $mdp_check){

        echo "<p class='message_erreur'>Les 2 mots de passe de correspondent pas !</p>";

      }

      //SI PAS DE LIGUE SELECTIONNE
      else if ($id_ligue == '5'){

        echo "<p class='message_erreur'>Veuillez selectionner une ligue !</p>";

      }
      //DANS LES AUTRES CAS AJOUTE L'USER A LA BDD
      else {

        try {
          $sth = $dbh->prepare($sql);
          $sth->execute(array(
            ":id_user" => $id_user,
            ":pseudo" => $pseudo,
            ":mdp" => $mdp,
            ":mail" => $mail,
            ":id_usertype" => $id_usertype,
            ":id_ligue" => $id_ligue));
          } catch (PDOException $ex) {
          die("Erreur lors de la requête SQL : " . $ex->getMessage());
          }

          echo "<p class='message_validation'>Compte créé avec succés !</p>";
          echo "<p class='message_validation'>Redirection vers login dans 5 sec !</p>";
        
          echo '<meta http-equiv="refresh" content="5;URL=\'http://localhost/projets/AppFAQ/AppFAQ/login.php\'">'; // REDIRECTION APRES 5 SECONDES VERS LOGIN.PHP (ATTENTION L'URL MARCHE SUR MON PC MAIS PAS AILLEURS JE PENSE)
      }
    }
?>