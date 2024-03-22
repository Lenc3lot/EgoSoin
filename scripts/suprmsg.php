<?php

$liaison = mysqli_connect("localhost", "root", "", "egosoin");
$rqt = "DELETE FROM messagerie WHERE P_id = " . $_POST["idpatient"] . "";
$leflux = mysqli_query($liaison, $rqt);
mysqli_close($liaison);


?>