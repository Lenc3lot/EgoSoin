<!DOCTYPE html>
<html>
<!-- ENTETE -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Page Des patient</title>
</head>
<!-- BODY -->

<body>
    <header>
        <ul id="menu">
            <li>Acceuil</li>
            <li>Créer un compte</li>
            <li>
                <form name="test" action="./deco.php">
                    <button name="Deconnexion">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>

    <?php 
        $liaison = mysqli_connect("localhost","root","","egosoin");
        $rqt = ("SELECT C_compteRendu FROM consultation WHERE C_id= ".$_POST['C_id']." ");
        $leflux = mysqli_query($liaison,$rqt);

        while ($ligne = mysqli_fetch_assoc($leflux)) {
            echo "Voici le compte rendu de votre consultation :".$ligne["C_compteRendu"];
        }
    ?>
    <br>
    <a href="../ppatient.php">Retour a la page des rendez vous</a>