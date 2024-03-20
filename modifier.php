<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AppFAQ modifier</title>
</head>

<body>

    <header>
        <div class="titre">
            <h1>AppFAQ</h1>
        </div>
        <div class="boite_deconnecter">
            <a href="confirmer_deconnection.php"><span>Se déconnecter</span></a>
        </div>
    </header>

    <div class="page">
        <div class="modif">
            <div class="entete">
                <h1>Modifier un message</h1>
            </div>

            <div class="boites_modif">
                <label for="zoneTexte">Question</label><br>
                <textarea id="zoneTexte" name="zoneTexte" rows="4"
                    cols="50">Bonjour,Quels sports puis-je pratiquer dans votre maison de ligues ? Merci</textarea><br>

                <label for="zoneTexte">Réponse</label><br>
                <textarea id="zoneTexte" name="zoneTexte" rows="4"
                    cols="50">Notre maison de ligues propose une variété desports. (Rugby, Escrime...) Il y en a pour tout les goûts !</textarea><br>
                    
                </div>
                <br>
                <div class="b_modif">
                    <a href="message.php"><span>Valider</span></a>
                </div>
                <br>
                <div class="b_modif">
                    <a href="confirmer_suppression.php"><span>Supprimer</span></a>
                </div>
                <br>
                <div class="b_modif">
                    <a href="message.php"><span>Revenir en arrière</span></a>
                </div>
    
            </div>


    </div>
    <br><br><br>
    <?php footer(); ?>
</body>

</html>