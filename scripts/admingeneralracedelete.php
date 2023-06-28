<?php
session_start();
include_once("../connect.php");
$raceid = $_GET["raceid"];

if($_SESSION["rank"] == 2){
    mysqli_query($conn,"DELETE FROM race WHERE race.id_race = $raceid");
    Header("Location:../index.php?pages=admin&adminpage=admingeneral");
}
else{
    Header("Location:../index.php?pages=main");
}
?>
