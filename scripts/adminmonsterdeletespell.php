<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $spellid = $_GET["spellid"];
    $monsterid = $_GET["monsterid"];

    mysqli_query($conn,"DELETE FROM monsters_has_spells WHERE Monsters_id_monster = $monsterid AND Spells_id_spells = $spellid");
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>