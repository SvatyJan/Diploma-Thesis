<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $spellid = $_GET["spellid"];
    $statid = $_GET["statid"];

    mysqli_query($conn,"DELETE FROM spells_has_stats WHERE Spells_id_spells = $spellid AND Stats_id_stats = $statid");
    Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
} else {
    Header("Location:../index.php?pages=main");
}
?>