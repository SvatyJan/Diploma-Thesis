<?php
include("../connect.php");
include("../functions.php");
require("../classes/monsterclass.php");
require("../classes/playerclass.php");
require("../classes/itemclass.php");
require("../classes/spellclass.php");

$playerjson = json_decode($_POST["json"]);
$playerjsonencode = array("playerid" => $playerjson->{'playerid'}, "targetid" => $playerjson->{'targetid'}, "action" => $playerjson->{'action'}, $playerjson->{'spellposition'});

$playerid = $playerjson->{'playerid'};
$targetid = $playerjson->{'targetid'};
$action = $playerjson->{'action'};
$spellposition = $playerjson->{'spellposition'};
//echo "spellposition: ".$spellposition;

$target = MonsterFactory::createMonster($playerjson->{'targetid'});
$player = PlayerFactory::createPlayer($playerjson->{'playerid'});

//zjisti ktere je prvni kouzlo
$kouzlo = Select("SELECT * FROM characters_has_spells JOIN Spells ON spells.id_spells = characters_has_spells.Spells_id_spells
         WHERE characters_has_spells.Spellslots_id_spellslots = 3 AND vJakemJeSlotu = $spellposition AND Characters_id_character = ?", $playerid, $conn)[0];
$kouzloid = $kouzlo["id_spells"];
//echo $kouzlo["spellname"].$kouzloid;

//$jaketojekouzlo = Select("SELECT * FROM `spells` JOIN spells_has_stats ON spells.id_spells = spells_has_stats.Spells_id_spells WHERE spells.id_spells = ?",$kouzloid,$conn);
$spellstaty = mysqli_query($conn, "SELECT * FROM spells JOIN spells_has_stats ON spells.id_spells = spells_has_stats.Spells_id_spells WHERE spells.id_spells = $kouzloid");

$cooldown = 0;
$strmultiplier = 0;
$agimultiplier = 0;
$intmultiplier = 0;

if (mysqli_num_rows($spellstaty) > 0) {
    $playerspells = $player->getSpells();
    foreach ($playerspells as $playerspell) {
        if ($playerspell->getSpellname() === $kouzlo["spellname"]) {
            $cooldown = $playerspell->getCooldown();
            $strmultiplier = $playerspell->getStrengthmultiplier();
            $agimultiplier = $playerspell->getAgilitymultiplier();
            $intmultiplier = $playerspell->getIntelligencemultiplier();
        }
    }
}

$getcombatid = Select("SELECT * FROM combat WHERE id_player = ?", $playerid, $conn)[0];
$combatid = $getcombatid["id_combat"];

$gettargethp = Select("SELECT * FROM combat_has_monsters WHERE Monsters_id_monster = ?", $targetid, $conn)[0];
$hpzdb = $gettargethp["currentHealth"];
$target->setCurrentHealth($hpzdb);

$getplayerhp = Select("SELECT * FROM combat_has_characters WHERE Characters_id_character = ?", $playerid, $conn)[0];
$playercurrenthp = $getplayerhp["currentHealth"];
$player->setCurrentHealth($playercurrenthp);


$newtargethp = $hpzdb;
/* LOGIKA KOUZEL */
if ($kouzlo["spellname"] === "Crushing Blow") {
    $celkovydmg = round(10 + ($player->getTotalDamage() * 0.8));
    if ($target->getArmor() > $celkovydmg) {
    } else {
        $newtargethp = $target->getCurrentHealth() - $celkovydmg;
        $target->setCurrentHealth($newtargethp);
    }
}

if ($kouzlo["spellname"] === "Overload") {
    $celkovydmg = round(10 + ($player->getTotalIntelligence() * 0.8));
    if ($target->getMagic_resist() > $celkovydmg) {
    } else {
        $newtargethp = $target->getCurrentHealth() - $celkovydmg;
        $target->setCurrentHealth($newtargethp);
    }
}

if ($kouzlo["spellname"] === "Shiv") {
    $celkovydmg = round(10 + ($player->getTotalAgility() * 0.8));
    if ($target->getMagic_resist() > $celkovydmg) {
    } else {
        $newtargethp = $target->getCurrentHealth() - $celkovydmg;
        $target->setCurrentHealth($newtargethp);
    }
}

if ($kouzlo["spellname"] == "Rejuvenation") {
    //toto je heal spell
    $healvalue = round(20 + ($player->getTotalIntelligence() * $intmultiplier));
    $newplayerhp = $player->getCurrentHealth() + $healvalue;
    $player->setCurrentHealth($player->getCurrentHealth() + $healvalue);
    if ($player->getCurrentHealth() >= $player->getTotalHealth()) {
        $player->setCurrentHealth($player->getTotalHealth());
    }
    $newplayerhp = $player->getCurrentHealth();
    $setplayerhp = mysqli_query($conn, "UPDATE `combat_has_characters` SET `currentHealth` = $newplayerhp
                             WHERE `combat_has_characters`.`Combat_id_combat` = $combatid AND `Combat_has_characters`.`characters_id_character` = $playerid");
}


$settargethp = mysqli_query($conn, "UPDATE `combat_has_monsters` SET `currentHealth` = $newtargethp
                             WHERE `combat_has_monsters`.`Combat_id_combat` = $combatid AND `combat_has_monsters`.`Monsters_id_monster` = $targetid");

$playerjsonsend = array("playername" => $player->getUsername(), "monstername" => $target->getUsername(), "playercurrenthp" => $player->getCurrentHealth(),
    "playermaxhp" => $player->getTotalHealth(), "monstercurrenthp" => $target->getCurrentHealth(), "monstermaxhp" => $target->getTotalHealth());
echo json_encode($playerjsonsend);

//vystup by mel byt: player, currenthp, maxhp
// monster, currenthp, maxhp


?>
