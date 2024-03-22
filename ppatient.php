<!DOCTYPE html>
<html>
<!-- ENTETE -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./scripts/style.css">
    <title>Page Des patient</title>
</head>
<!-- BODY -->

<body>
    <header>
        <ul id="menu">
            <li>Acceuil</li>

            <li>
                <form name="test" action="./scripts/deco.php">
                    <button name="Deconnexion">Déconnexion</button>
                </form>
            </li>
        </ul>
    </header>

    <?php
    //CODE PHP 
    session_start();
    if (isset($_SESSION['Ppnom'])) {
        $date = new DateTime('now');
        $result = $date->format('Y-m-d');
        $liaison = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
        $rqt = ("SELECT * FROM consultation WHERE P_id=  " . $_SESSION['Pid'] . " AND C_date>'$result' "); // Sélectionne les consultations ou date > date du jour 
        $leflux = mysqli_query($liaison, $rqt);

        //MESSAGE AFFICHE
        echo "Bonjour  " . $_SESSION['Ppnom'] . " " . $_SESSION['Pnom'] . ", bienvenue sur votre espace patient. <br>    Nous sommes le : ";
        echo $result;

        

        echo '
        <h1> Voici vos futures consultations</h1>
        <table>
            <tr>
                <th>ID consult</th>
                <th> Date </th>
                <th> Heure </th>
                <th> Action </th>
            </tr>';

        while ($ligne = mysqli_fetch_assoc($leflux)) {
            echo '<form name="MonForm" method="post" action="./scripts/supprrdv.php">
                <tr>
                    <td>
                        <input name="C_id" value="' . $ligne["C_id"] . '" hidden>' . $ligne["C_id"] . '
                    </td>
                    <td>
                        ' . $ligne["C_date"] . '
                    </td>
                    <td>
                        ' . $ligne["C_heure"] . '
                    </td>
                    <td>
                        <input type="submit" value="Supprimer le rendez vous." />
                    </td>
                </tr>
            </form>';
        } ?>
        </table>
        <?php
    } else {
        header("Location: ./acceuil.php");
    } ?>



    <?php

    if (isset($_GET["ConsultPrec"]) && $_GET["ConsultPrec"] == "Display") { //Affichage du bouton "Display" ou "Hide" en fonction de ce qui est voulu
        echo '
    <form name="=FormDateAnté" method="get" action="">
        <input type="submit" name="ConsultPrec" value="Hide">
    </form>';

        $liaison2 = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
        $rqt2 = ("SELECT * FROM consultation WHERE P_id=  " . $_SESSION['Pid'] . " AND C_date < '$result' "); // Sélectionne les consultations ou date < date du jour 
        $leflux2 = mysqli_query($liaison2, $rqt2);
        echo '
        <h1> Voici vos anciennes consultations</h1>
        <table>
            <tr>
                <th>ID consult</th>
                <th> Date </th>
                <th> Heure </th>
                <th> Action </th>
            </tr>';

        while ($ligne = mysqli_fetch_assoc($leflux2)) {
            echo '<form name="MonForm" method="post" action="./scripts/cptrendu.php">
                <tr>
                    <td>
                        <input name="C_id" value="' . $ligne["C_id"] . '" hidden>' . $ligne["C_id"] . '
                    </td>
                    <td>
                        ' . $ligne["C_date"] . '
                    </td>
                    <td>
                        ' . $ligne["C_heure"] . '
                    </td>
                    <td>
                        <input type="submit" value="Compte-rendu du rendez vous." />
                    </td>
                </tr>
            </form>';
        }
        echo '</table>';
        unset($_GET["ConsultPrec"]);
    } else {
        echo '
    <form name="=FormDateAnté" method="get" action="">
        <input type="submit" name="ConsultPrec" value="Display">
    </form>';
    }
    ?>

    <?php
    if (isset($_GET["BtMsg"]) && $_GET["BtMsg"] == "Message" || isset($_GET["CodeMsg"]) || isset($_GET["CodeErr"])) {
        

        $liaison3 = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
        $rqt3 = ("SELECT DISTINCT M_code FROM consultation WHERE P_id = " . $_SESSION['Pid'] . ""); // Sélectionne les médecins du P_id en sessions des anciennes consults
        $leflux3 = mysqli_query($liaison3, $rqt3);


        echo '
        <form name="=FormMsg" method="get" action="">
        <input type="submit" name="BtMsg" value="Cacher">
        </form>
        ';

        if (isset($_GET["CodeErr"]) && $_GET["CodeErr"] == 1){
            echo 'MERCI DE SELECTIONNER UN DOCTEUR VALIDE!';
        }
        
        if (isset($_GET["CodeMsg"])){
            echo ' VOTRE MESSAGE A BIEN ETE ENVOYE !';
        }

        
        echo'
        
    <section class="cookie">
        <form name="msgrie" method="post" action="./scripts/submitmsg.php">
            <textarea maxlength="255" name="Saisie" class="znsaisie" placeholder="Saisisez votre message (max 255 caractères)"></textarea>
            <select name ="doc" id="doc">
                <option value="ChoixDoc" selected disabled> Choix du médecin </option>';

        while ($ligne7 = mysqli_fetch_assoc($leflux3)) {
            echo '<option value = "' . $ligne7["M_code"] . '">' . $ligne7["M_code"] . '</option>';
        }

        echo '
            </select>
            <input type="submit" name="btvalider" value="Envoyer le msg"/>
        </form>
    </section>
        ';

    } else {
        echo '
    <form name="=FormMsg" method="get" action="">
        <input type="submit" name="BtMsg" value="Message">
    </form>';

    }
    ?>

</body>

</html>