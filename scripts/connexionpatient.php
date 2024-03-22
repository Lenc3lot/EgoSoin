<?php 
session_start();

$username = "root";
$password  = "";
$database = "egosoin";

//Connexion a la BDD 
$liaison =  mysqli_connect("localhost",$username,$password,$database) or exit(mysqli_error());

$rqtprep = mysqli_prepare($liaison, "SELECT P_id,P_nom,P_prenom FROM patient WHERE P_login=? AND P_mdp=?");

mysqli_stmt_bind_param($rqtprep,"ss",$Plogin,$Pmdp);

$Plogin = $_POST['Plogin'];
$Pmdp = $_POST['Pmdp'];

mysqli_execute($rqtprep);

mysqli_stmt_bind_result($rqtprep,$Pid,$Pnom,$Ppnom);

$row = mysqli_stmt_fetch($rqtprep);

$_SESSION['rqt']=$rqtprep;
$_SESSION['Pid']=$Pid;
$_SESSION['Ppnom']=$Ppnom;
$_SESSION['Pnom']=$Pnom;
$_SESSION['nom'] = $_POST['Plogin'];

//compter les colonnes retournées

if ($row == 0 ) {
	header("Location:../esp_patient.php?codeErr=1");
}else{
	header("Location:../ppatient.php");
}

$rqtprep -> close();
$liaison->close();

?>

