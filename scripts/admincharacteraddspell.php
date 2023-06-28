<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellname = $_POST["spellname"];
$characterid = $_POST["characterid"];

if ($_SESSION["rank"] == 2) {
    $idspellu = Select("SELECT * FROM spells 
    LEFT JOIN spellslots ON spellslots.id_spellslots = spells.Spellslots_id_spellslots
WHERE spellname = ?", $spellname, $conn, "s")[0];
    $newidspellu = $idspellu["id_spells"];
    $spellslotid = $idspellu["id_spellslots"];

    $macharacterkoulzos = Select("SELECT * FROM characters_has_spells WHERE Spells_id_spells = ?", $newidspellu, $conn);
    $kolikmaitemu = 0;

    foreach ($macharacterkoulzos as $macharacterkoulzo) {
        $kolikmaitemu++;
    }
    if ($kolikmaitemu === 0) {
        mysqli_query($conn, "INSERT INTO `characters_has_spells` (`Characters_id_character`, `Spells_id_spells`, `Spellslots_id_spellslots`, `vJakemJeSlotu`)
 VALUES ($characterid, $newidspellu, $spellslotid, '0')");
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>