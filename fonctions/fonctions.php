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


function db_add_user() {

    $dbh = db_connect();

    $id_user = "NULL";
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : "";
    $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    $id_usertype = "0";
    $id_ligue = isset($_POST['id_ligue']) ? $_POST['id_ligue'] : "0";

    $sql="insert into user values (:id_user,:pseudo,:mdp,:mail,:id_usertype,:id_ligue)";
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

}







?>