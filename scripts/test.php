<?php 

$mysqli = new mysqli("localhost","root","","egosoin");

$stmt = $mysqli ->prepare("SELECT S_nom FROM secretaire WHERE S_login=?");

$Slogin = $_POST['Slogin'];
echo $Slogin;
$stmt -> bind_param("s",Slogin);



$data = [
	1=>"PHP",
	2=>"Mon Cul"
	];

foreach ($data as $Slogin) {
	$stmt->execute();
}


