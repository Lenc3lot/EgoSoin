<!DOCTYPE html>
<html>
<!-- ENTETE -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./scripts/style.css">
	<script src="./scripts/btn.js"></script> 
	<title>Page Des secrétaire</title>
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
	if (isset($_SESSION['Spnom'])) {

		$date = new DateTime('now');
		$result = $date->format('Y-m-d');
		$liaison = mysqli_connect("localhost", "root", "", "egosoin") or exit(mysqli_error());
		$rqt = ("SELECT * FROM consultation WHERE C_date='$result' "); // Sélectionne les consultations ou date > date du jour 
		$leflux = mysqli_query($liaison, $rqt);


		//MESSAGE AFFICHE
		echo "Bonjour secrétaire " . $_SESSION['Spnom'] . " " . $_SESSION['Snom'];
		if (!isset($_GET["modif"])) {
			echo '
        <h1> Voici les consultations du jour :</h1>
        <table>
            <tr>
                <th>ID consult</th>
				<th> Id Patient </th>
                <th> Date </th>
                <th> Heure </th>
				<th> Compte Rendu </th>
                <th> Actions </th>
				
            </tr>';

			while ($ligne = mysqli_fetch_assoc($leflux)) {
				echo '<form name="MonForm" method="get" action="">
                <tr>
                    <td>
                        <input name="C_id" value="' . $ligne["C_id"] . '" hidden>' . $ligne["C_id"] . '
                    </td>
					<td>
						<input name = "P_id" value="' . $ligne["P_id"] . '" hidden>' . $ligne["P_id"] . '
					</td>
                    <td>
                        <input name="C_date" value="' . $ligne["C_date"] . '" hidden>' . $ligne["C_date"] . '
                    </td>
                    <td>
                        <input name= "C_heure" value="' . $ligne["C_heure"] . '" hidden>' . $ligne["C_heure"] . '
                    </td>
					<td>
						<input name= "C_compteRendu" value="' . $ligne["C_compteRendu"] . '" hidden>' . $ligne["C_compteRendu"] . '
					</td>
                    <td>
                        <input type="submit" name="modif" value="Modifier" />
                    </td>
                </tr>
            </form>';
			}
		} else {
			echo '
			<h1> Modifier la consultations suivante :</h1>
			<form name="MonForm2" method="get" action="./scripts/">
			<table>
			<tr>
				<th>ID consult</th>
				<th> Id Patient </th>
				<th> Date </th>
				<th> Heure </th>
				<th> Compte Rendu </th>
				<th> Actions </th>
			</tr>
				<td>
                	<input name="C_id" value="' . $_GET["C_id"] . '" hidden>' . $_GET["C_id"] . '
            	</td>
				<td>
					<input name="P_id" value="' . $_GET["P_id"] . '" hidden>' . $_GET["P_id"] . '
				</td>
            	<td>
                	<input name="C_dateM" value="' . $_GET["C_date"] . '" >
            	</td>
            	<td>
					<input name="C_heure" value="' . $_GET["C_heure"] . '" hidden>' . $_GET["C_heure"] . '           
				</td>
				<td>
					<input name="C_compteRendu1" value="' . $_GET["C_compteRendu"] . '">
 				</td>
            	<td>
                	<input type="submit" name="test3" value="Valider" />
            	</td>
			<tr>';

		}
		echo '</table>';



	} else {
		header("Location: ./acceuil.php");
	} ?>

	<h1>Voici les messages des patients</h1>
	<table>
		<form name="RepMsg" method="post" action="">
			<tr>
				<th>ID Message</th>
				<th>Nom Patient</th>
				<th> Nom Médecin </th>
				<th> Date D'envoi </th>
				<th> Message </th>
				<th> Actions </th>
			</tr>
			<?php

			//NbTotalMSG
			$nbmsg = "SELECT count(*) AS Compte FROM messagerie";
			$exec = mysqli_query($liaison, $nbmsg);
			$nb = mysqli_fetch_assoc($exec);
			$nbmsgtest = $nb["Compte"];
			echo ceil($nbmsgtest/5);

			echo '
			Afficher la page : 
			<select>';
			
			for ($i=1; $i <= ceil($nbmsgtest/5) ; $i++) { 
				echo '<option value='.$i.'>'.$i.'</option>';
			} 


			
			echo '</select>';

			$nombre = 0;
			$requete = "Select * FROM messagerie ORDER BY DateEnvoi DESC"; // LIMIT $nombre,5";
			$flux1 = mysqli_query($liaison, $requete);
			



			foreach ($flux1 as $element) {
				$requete1 = "Select P_nom,P_mail FROM patient WHERE P_id = '$element[P_id]'";
				$flux2 = mysqli_query($liaison, $requete1);
				$testencore = mysqli_fetch_assoc($flux2);
				$mail = $testencore["P_mail"];

				$requete2 = "Select M_nom FROM medecin WHERE M_code = '$element[M_code]'";
				$flux3 = mysqli_query($liaison, $requete2);
				$testtjr = mysqli_fetch_assoc($flux3);


				echo '
		<tr>	
			<td>' . $element["IdMessage"] . '</td>
			<td><input type="text" name="idpatient" value =' . $element["P_id"] . ' hidden>' . $testencore["P_nom"] . '</td>
			<td>' . $testtjr["M_nom"] . '</td>
			<td>' . $element["DateEnvoi"] . '</td>
			<td>' . $element["ContenuMsg"] . '</td>
			<td><a href="mailto:' . $mail . '">Répondre <input type="submit" value="Feur"></td>
		</tr>';
			} ?>
		</form>
	</table>

	<div id="btn" onclick=ChangeBtn()><div id="cercle" data-etat="off"></div></div>

</body>

</html>