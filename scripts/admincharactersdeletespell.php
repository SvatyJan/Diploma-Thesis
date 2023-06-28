<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellid = $_GET["spellid"];
$characterid = $_GET["characterid"];

if ($_SESSION["rank"] == 2) {
    mysqli_query($conn,"DELETE FROM characters_has_spells WHERE Characters_id_character = $characterid AND Spells_id_spells = $spellid");
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");

} else {
    Header("Location:../index.php?pages=main");
}
?>