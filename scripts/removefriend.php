<?php
session_start();
require("../connect.php");

$myid = $_SESSION["id"];
$hisid = $_GET["id"];

//echo $myid.$hisid;

$deletefriend = "DELETE FROM friends WHERE Characters_id_character = $myid AND Characters_id_character1 = $hisid LIMIT 1";
$resultdeletefriend = mysqli_query($conn,$deletefriend);

?>