<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellname = $_POST["spellname"];
$monsterid = $_POST["monsterid"];

if ($_SESSION["rank"] == 2) {
    $idspellu = Select("SELECT * FROM spells 
    LEFT JOIN spellslots ON spellslots.id_spellslots = spells.Spellslots_id_spellslots
WHERE spellname = ?", $spellname, $conn, "s")[0];
    $newidspellu = $idspellu["id_spells"];
    $spellslotid = $idspellu["id_spellslots"];

        mysqli_query($conn, "INSERT INTO `monsters_has_spells` (`Monsters_id_monster`, `Spells_id_spells`, `Spellslots_id_spellslots`, `vJakemJeSlotu`)
 VALUES ($monsterid, $newidspellu, $spellslotid, '0')");

    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>