<?php
$liaison = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
$rqt = ("SELECT * FROM consultation WHERE P_id=  " . $_SESSION['Pid'] . " ");
$leflux = mysqli_query($liaison, $rqt);
echo "Bonjour patient " . $_SESSION['Ppnom'] . " " . $_SESSION['Pnom'] . ".\n Nous sommes le : ";
$today = date("Y-m-d");

while ($ligne = mysqli_fetch_assoc($leflux)) {
    if ($today > $ligne["C_date"])
        echo "hello";
} 

?>