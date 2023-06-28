<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterid = $_GET["id"];

echo $_SESSION["rank"];

if ($_SESSION["rank"] == 2) {
    mysqli_query($conn,"DELETE FROM `monsters` WHERE `monsters`.`id_monster` = $monsterid");
    Header("Location:../index.php?pages=admin&adminpage=adminmonsters");
} else {
    Header("Location:../index.php?pages=main");
}

?>