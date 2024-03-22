<?php



//FONCTION DE CONNECTION A LA BDD APPFAQ
function db_connect()
{
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
function db_add_user()
{
  //TRUE SI USER CREE OU RESTE FALSE SI PAS CREE
  $_GET['user_cree'] = FALSE;
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
  $i = isset($_GET['i_value']) ? $_GET['i_value'] : "";


  //REQUETE POUR VOIR SI PSEUDO DEJA DANS LA BDD

  $sql1 = "select pseudo from user where pseudo =:pseudo";
  try {
    $sth = $dbh->prepare($sql1);
    $sth->execute(array(':pseudo' => $pseudo));
    $pseudo_bdd = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }

  //REQUETE POUR VOIR SI MAIL DEJA DANS LA BDD
  $sql2 = "select mail from user where mail =:mail";
  try {
    $sth = $dbh->prepare($sql2);
    $sth->execute(array(':mail' => $mail));
    $mail_bdd = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }

  //CHECK DES ERREURS DE SAISIS POUR EVITER DES INSERTIONS NON-CONFORME(S)
  if ($mdp != $mdp_check || $id_ligue == '5' || count($pseudo_bdd) > 0 || count($mail_bdd) > 0) {

    //CAS OU LES 2 MDP SAISIS NE CORRESPONDENT PAS
    if ($mdp != $mdp_check) {
      echo "<p class='message_erreur'>Les 2 mots de passe de correspondent pas !</p>";
    }

    //SI PAS DE LIGUE SELECTIONNE
    if ($id_ligue == $i) {
      echo "<p class='message_erreur'>Veuillez selectionner une ligue !</p>";
    }

    //CAS PSEUDO DEJA UTILISE
    if (count($pseudo_bdd) > 0) {
      echo "<p class='message_erreur'>Ce pseudo déja utilisé !</p>";
    }

    //CAS MAIL DEJA UTILISE
    if (count($mail_bdd) > 0) {
      echo "<p class='message_erreur'>Ce mail est déja utilisé !</p>";
    }
  }
  //DANS LES AUTRES CAS ON PEUT AJOUTER L'USER A LA BDD
  else {

    //REQUETES QUI CONTIENT LA REQUETES SQL D'INSERTION DE L'USER
    $sql = "insert into user values (:id_user,:pseudo,:mdp,:mail,:id_usertype,:id_ligue)";

    //HACHAGE DU MDP AVANT DE LE STOCKER
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array(
        ":id_user" => $id_user,
        ":pseudo" => $pseudo,
        ":mdp" => $mdp,
        ":mail" => $mail,
        ":id_usertype" => $id_usertype,
        ":id_ligue" => $id_ligue
      ));
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }

    $_GET['user_cree'] = true;

    echo "<p class='message_validation'>Compte créé avec succés !</p>";
    echo "<p class='message_validation'>Redirection vers login dans 5 sec !</p>";



    echo '<meta http-equiv="refresh" content="5;URL=\'http://localhost/projets/AppFAQ/AppFAQ/login.php\'">'; // REDIRECTION APRES 5 SECONDES VERS LOGIN.PHP (ATTENTION L'URL MARCHE SUR MON PC MAIS PAS AILLEURS JE PENSE)
  }
}


//FONCTION QUI GERE LA CONNEXION D'UN UTILISATEUR
function userLogin()
{

  //CONNEXION A LA BDD
  $dbh = db_connect();

  //RECUPERATION DES CREDENTIALS DU FORMULAIRE
  $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : "";
  $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : "";


  $sql_login_pseudo = "select pseudo from user where pseudo =:pseudo";
  try {
    $sth = $dbh->prepare($sql_login_pseudo);
    $sth->execute(array(':pseudo' => $pseudo));
    $resultat_login_pseudo = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }

  if (count($resultat_login_pseudo) > 0) {
    $sql_login_mdp = "select mdp from user where pseudo =:pseudo";
    try {
      $sth = $dbh->prepare($sql_login_mdp);
      $sth->execute(array(
        ':pseudo' => $pseudo
      ));
      $resultat_login_mdp = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }

    //RECUPERATION DE L'ID + LIB DE LA LIGUE DE L'USER
    $sql_id_ligue = "select id_ligue from user where pseudo =:pseudo"; //CHANGER POUR RECUP ID LIGUE DIRECTEMENT DEPUIS LE POST 
    try {
      $sth = $dbh->prepare($sql_id_ligue);
      $sth->execute(array(':pseudo' => $pseudo));
      $resultat_id_ligue = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $id_ligue = $resultat_id_ligue['id_ligue'];

    $sql_lib_ligue = "select lib_ligue from ligue where id_ligue =:id_ligue";
    try {
      $sth = $dbh->prepare($sql_lib_ligue);
      $sth->execute(array(':id_ligue' => $id_ligue));
      $resultat_lib_ligue = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $lib_ligue = $resultat_lib_ligue['lib_ligue'];


    $sql_id_user = "select id_user from user where pseudo =:pseudo";
    try {
      $sth = $dbh->prepare($sql_id_user);
      $sth->execute(array(':pseudo' => $pseudo));
      $resultat_id_user = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $id_user = $resultat_id_user['id_user'];

    /* RECUP ID_USERTYPE*/
    $sql_id_usertype = "select user.id_usertype from user where pseudo =:pseudo";
    try {
      $sth = $dbh->prepare($sql_id_usertype);
      $sth->execute(array(':pseudo' => $pseudo));
      $resultat_id_usertype = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $id_usertype = $resultat_id_usertype['id_usertype'];




    if ($resultat_login_mdp && password_verify($mdp, $resultat_login_mdp['mdp'])) {

      //CONNEXION REUSSIE
      $_SESSION['pseudo'] = $pseudo;
      $_SESSION['mdp'] = $mdp;
      $_SESSION['id_ligue'] = $id_ligue;
      $_SESSION['lib_ligue'] = $lib_ligue;
      $_SESSION['id_user'] = $id_user;
      $_SESSION['id_usertype'] = $id_usertype;

      header("location:message.php");
    } else {
      echo "<p> mot de passe incorrect ! </p>";


      echo count($resultat_login_mdp);
    }
  } else {

    echo "<p> Le compte n'existe pas ! </p>";
  }
}



// FONCTION DE DECONNEXION 
function deconnexion()
{

  session_unset(); // Détruit toutes les variables de session
  session_destroy(); // Détruit la session (mais pas le cookie)
  setcookie(session_name(), '', -1, '/'); // Détruit le cookie de session
  // Redirection vers index.php
  header("Location: index.php");
  exit();
}


function liste_messages_ligue()
{
  //CONNEXION A LA BDD
  $dbh = db_connect();
  $id_ligue = $_SESSION['id_ligue'];

  $sql_affichage_Q_R =
    "SELECT user_question.pseudo AS pseudo_question, faq.question, user_reponse.pseudo AS pseudo_reponse, faq.reponse
  FROM faq, user AS user_question, user AS user_reponse
  WHERE faq.id_user_question = user_question.id_user
  AND faq.id_user_reponse = user_reponse.id_user
  AND faq.id_ligue = :id_ligue
  ORDER BY faq.dat_question DESC;";

  try {
    $sth = $dbh->prepare($sql_affichage_Q_R);
    $sth->execute(array(':id_ligue' => $id_ligue));
    $resultats = $sth->fetchAll(PDO::FETCH_ASSOC);

    //PERMET DE NE PAS ECRASER LES DONNEES AVEC DES INDEXES
    foreach ($resultats as $index => $resultat) {
      $_SESSION['pseudo_question_' . $index] = $resultat['pseudo_question'];
      $_SESSION['texte_question_' . $index] = $resultat['question'];
      $_SESSION['pseudo_reponse_' . $index] = $resultat['pseudo_reponse'];
      $_SESSION['texte_reponse_' . $index] = $resultat['reponse'];
    }
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }
}

function ajouter_message()
{
  $id_user = $_SESSION['id_user']; //Je récup les id user et id ligue dans login
  $id_ligue = $_SESSION['id_ligue'];
  $question = isset($_POST['question']) ? $_POST['question'] : '';

  $dbh = db_connect();
  $sql = "INSERT INTO faq (question, dat_question, id_user_question, id_user_reponse, id_ligue) 
            VALUES (:question, NOW(), :id_user, 999, :id_ligue)"; //la réponse est "Pas de réponse !" par défaut, et c'est l'user 999 qui l'écrit (je peux pas mettre NULL, il faut forcément un user réponse)

  $params = array(
    ":question" => $question,
    ":id_user" => $id_user,
    ":id_ligue" => $id_ligue
  );

  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    echo "Question insérée avec succès."; //juste pour le débug, on peut l'enlever à la fin
  } catch (PDOException $e) {
    echo "Erreur lors de l'insertion de la question: " . $e->getMessage();
  }
}

function footer()
{
  echo '<footer>
        <p>BTS SIO &copy;2024 APPFAQ<br>Hugo FAURE, Sylvain FACCIN, Samuel KAKEZ</p>
        </footer>';
}

function admin_check()
{

  if ($_SESSION['id_usertype'] == 0) {
    header("Location: message.php");
    exit();
  }
}



function supprimer_message() {

  $dbh = db_connect();

  $id_faq = $_GET['id_faq'];
  $submit = isset($_POST['submit_suppr']);

  $sql="DELETE FROM faq WHERE id_faq=:id_faq;";

  $params = array(
    ":id_faq" => $id_faq );

  if($submit){
    try {
      $sth = $dbh->prepare($sql);
      $sth->execute($params);
      echo "Question insérée avec succès."; //juste pour le débug, on peut l'enlever à la fin
    } catch (PDOException $e) {
      echo "Erreur lors de la suppression de la question: " . $e->getMessage();
    }

    header('Location: message.php');
  }

}


function modifier_message() {


  $question = isset($_POST['question']) ? $_POST['question'] : '';
  $reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';
  $id_faq = $_GET['id_faq'];

  $dbh = db_connect();
  $sql_modifier = "UPDATE faq
          set question = :question, 
          reponse = :reponse
          where id_faq = :id;";

  $params = array(
    ":question" => $question,
    ":reponse" => $reponse,
    ":id_faq" => $id_faq
  );

  try {
    $sth = $dbh->prepare($sql_modifier);
    $sth->execute($params);
    echo "Question modifiée."; //juste pour le débug, on peut l'enlever à la fin
  } catch (PDOException $e) {
    echo "Erreur lors de la modification de la question: " . $e->getMessage();
  }



}