<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellid = $_POST["spellid"];
$monsterid = $_POST["monsterid"];
$vjakemjeslotu = $_POST["vjakemjeslotu"];
$spellslotid = $_POST["spellslotid"];

if ($_SESSION["rank"] == 2) {

    if ($vjakemjeslotu == 0) {
        $upravkouzlo = mysqli_query($conn, "UPDATE `monsters_has_spells` SET `vJakemJeSlotu` = $vjakemjeslotu WHERE `monsters_has_spells`.`Monsters_id_monster` = $monsterid 
        AND `monsters_has_spells`.`Spells_id_spells` = $spellid AND `monsters_has_spells`.`Spellslots_id_spellslots` = $spellslotid");
    } else {

        //zjisti jestli už v daném slotu je nějaké kouzlo
        $jeveslotuuzkouzo = mysqli_query($conn, "SELECT * FROM `monsters_has_spells`WHERE Monsters_id_monster = $monsterid
    AND Spellslots_id_spellslots = $spellslotid AND vJakemJeSlotu = $vjakemjeslotu LIMIT 1");

        if (mysqli_num_rows($jeveslotuuzkouzo) === 0) {
            $upravkouzlo = mysqli_query($conn, "UPDATE `monsters_has_spells` SET `vJakemJeSlotu` = $vjakemjeslotu WHERE `monsters_has_spells`.`Monsters_id_monster` = $monsterid 
        AND `monsters_has_spells`.`Spells_id_spells` = $spellid AND `monsters_has_spells`.`Spellslots_id_spellslots` = $spellslotid");
        }
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>