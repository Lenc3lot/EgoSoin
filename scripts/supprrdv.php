<?php 
    $liaison = mysqli_connect("localhost","root","","egosoin");
    $rqt = ("DELETE FROM consultation WHERE C_id = ".$_POST["C_id"]."" );
    $leflux = mysqli_query($liaison, $rqt);
    mysqli_close($liaison);
header("Location: ../ppatient.php");
?>