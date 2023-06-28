<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterid = $_POST["monsterid"];


if ($_SESSION["rank"] == 2) {
    $statid = $_POST["statid"];
    $statvalue = $_POST["statvalue"];

    mysqli_query($conn, "UPDATE monsters_has_stats SET value = $statvalue WHERE Monsters_id_monster = $monsterid AND Stats_id_stats = $statid");

    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>