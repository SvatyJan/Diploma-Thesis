<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
require("../classes/playerclass.php");
require("../classes/monsterclass.php");
require("../classes/itemclass.php");
require("../classes/spellclass.php");
$playerid = $_SESSION["id"];

$mahraccombat = SELECT("SELECT * FROM combat WHERE id_player = ?", $playerid, $conn);

if (count($mahraccombat) > 0) {
    echo "hráč má combat, rovnou ho tam hodim";
    Header("Location: ../index.php?pages=combat");
} else {
    echo "hráč nemá combat, generuju combat a pak ho tam hodim";
    $startcombat = mysqli_query($conn, "INSERT INTO `combat` (`id_combat`, `id_player`, `finished`) VALUES (NULL, $playerid, '0')");

    $idcombatudb = SELECT("SELECT * FROM combat WHERE id_player = ?", $playerid, $conn)[0];
    $idcombatu = $idcombatudb["id_combat"];

    $player = PlayerFactory::createPlayer($playerid);
    $playerid = $player->getId();
    $hphrace = $player->getTotalHealth();

    $addcharactertocombat = mysqli_query($conn, "INSERT INTO `combat_has_characters` 
    (`Combat_id_combat`, `Characters_id_character`, `team`, `currentHealth`) VALUES ($idcombatu, $playerid, '0', $hphrace);");

    $howmanymonsters = mysqli_query($conn, "SELECT * FROM monsters");
    $randommonsterid = rand(1, mysqli_num_rows($howmanymonsters));
    $monster = MonsterFactory::createMonster($randommonsterid);
    $monsterid = $monster->getId();
    $hpmonstra = $monster->getTotalHealth();

    $addmonstertocombat = mysqli_query($conn, "INSERT INTO `combat_has_monsters` 
    (`Combat_id_combat`, `Monsters_id_monster`, `team`, `currentHealth`) VALUES ($idcombatu, $monsterid, '1', $hpmonstra);");

    Header("Location: ../index.php?pages=combat");
}


?>
