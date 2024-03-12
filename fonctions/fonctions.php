<?php
//FONCTION DE CONNECTION A LA BDD APPFAQ
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
                if($mdp != $mdp_check || $id_ligue == '5' || count($pseudo_bdd)>0 || count($mail_bdd)>0){
                  
                  //CAS OU LES 2 MDP SAISIS NE CORRESPONDENT PAS
                  if ($mdp != $mdp_check){
                    echo "<p class='message_erreur'>Les 2 mots de passe de correspondent pas !</p>";
                  }

                  //SI PAS DE LIGUE SELECTIONNE
                  if ($id_ligue == $i){
                    echo "<p class='message_erreur'>Veuillez selectionner une ligue !</p>";
                  }

                  //CAS PSEUDO DEJA UTILISE
                  if (count($pseudo_bdd)>0) {
                    echo "<p class='message_erreur'>Ce pseudo déja utilisé !</p>";
                  }

                  //CAS MAIL DEJA UTILISE
                  if (count($mail_bdd)>0) {
                    echo "<p class='message_erreur'>Ce mail est déja utilisé !</p>";
                  }
                }
                //DANS LES AUTRES CAS ON PEUT AJOUTER L'USER A LA BDD
                else {

                  //REQUETES QUI CONTIENT LA REQUETES SQL D'INSERTION DE L'USER
                  $sql="insert into user values (:id_user,:pseudo,:mdp,:mail,:id_usertype,:id_ligue)";

                  //HACHAGE DU MDP AVANT DE LE STOCKER
                  $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

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

                    $_GET['user_cree']=true;

                    echo "<p class='message_validation'>Compte créé avec succés !</p>";
                    echo "<p class='message_validation'>Redirection vers login dans 5 sec !</p>";

                    
                  
                    echo '<meta http-equiv="refresh" content="5;URL=\'http://localhost/projets/AppFAQ/AppFAQ/login.php\'">'; // REDIRECTION APRES 5 SECONDES VERS LOGIN.PHP (ATTENTION L'URL MARCHE SUR MON PC MAIS PAS AILLEURS JE PENSE)
                }
              }

function userLogin()
{



















  



}
    

?>