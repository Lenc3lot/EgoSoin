<?php
session_start();
//récup les données du form
$Pid = $_SESSION['Pid'];
$msg = $_POST["Saisie"];
$doc = $_POST["doc"];
$date = date_create("now");
$result = $date->format('Y-m-d H-i-s');

if (isset($Pid) && $doc != null) {

    $liaison = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
    $rqt = "INSERT INTO messagerie VALUES (null, '$msg', '$result', '$doc', '$Pid')";
    $flux = mysqli_query($liaison,$rqt);

    header("Location: ../ppatient.php?CodeMsg=1");
} else {

    header("Location: ../ppatient.php?CodeErr=1");  

}



?>