<?php 
session_start();

$username = "root";
$password  = "";
$database = "egosoin";

//Connexion a la BDD 
$liaison =  mysqli_connect("localhost",$username,$password,$database) or exit(mysqli_error());

$rqtprep = mysqli_prepare($liaison, "SELECT S_id,S_nom,S_prenom FROM secretaire WHERE S_login=? AND S_mdp=?");

mysqli_stmt_bind_param($rqtprep,"ss",$Slogin,$Smdp);

$Slogin = $_POST['Slogin'];
$Smdp = $_POST['Smdp'];

mysqli_execute($rqtprep);

mysqli_stmt_bind_result($rqtprep,$Sid,$Snom,$Spnom);

$row = mysqli_stmt_fetch($rqtprep);

$_SESSION['rqt']=$rqtprep;
$_SESSION['Sid']=$Sid;
$_SESSION['Spnom']=$Spnom;
$_SESSION['Snom']=$Snom;
$_SESSION['nom'] = $_POST['Slogin'];

//compter les colonnes retournées

if ($row == 0 ) {
	header("Location:../esp_secrtr.php?codeErr=1");
}else{
	header("Location:../psecreteaire.php");
}

$rqtprep -> close();
$liaison->close();

?>

