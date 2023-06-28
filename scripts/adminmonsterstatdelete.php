<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $monsterid = $_GET["monsterid"];
    $statid = $_GET["statid"];

    mysqli_query($conn,"DELETE FROM monsters_has_stats WHERE Stats_id_stats = $statid AND Monsters_id_monster = $monsterid");
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>