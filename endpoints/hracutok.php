<?php
include("../connect.php");
include("../functions.php");
require("../classes/monsterclass.php");
require("../classes/playerclass.php");
require("../classes/itemclass.php");
require("../classes/spellclass.php");

$playerjson = json_decode($_POST["json"]);
$playerjsonencode = array("playerid"=>$playerjson->{'playerid'}, "targetid"=>$playerjson->{'targetid'}, "action"=>$playerjson->{'action'});

$target = MonsterFactory::createMonster($playerjson->{'targetid'});
$player = PlayerFactory::createPlayer($playerjson->{'playerid'});

$playerid = $player->getId();
$targetid = $target->getId();

$getcombatid = Select("SELECT * FROM combat WHERE id_player = ?",$playerid,$conn)[0];
$combatid = $getcombatid["id_combat"];

$gettargethp = Select("SELECT * FROM combat_has_monsters WHERE Monsters_id_monster = ?",$targetid,$conn)[0];
$hpzdb = $gettargethp["currentHealth"];
$target->setCurrentHealth($hpzdb);
$target->takeDamage($player->getTotalDamage() - $target->getTotalArmor());

$newtargethp = $target->getCurrentHealth();
if($target->getArmor() > $player->getTotalDamage()){
} else{
    $newtargethp = $target->getCurrentHealth();
}
$settargethp = mysqli_query($conn,"UPDATE `combat_has_monsters` SET `currentHealth` = $newtargethp
                             WHERE `combat_has_monsters`.`Combat_id_combat` = $combatid AND `combat_has_monsters`.`Monsters_id_monster` = $targetid");

//hraje další hráč
//$dalsihracnatahu = mysqli_query($conn,"UPDATE `combat` SET `hracvporadi` = 0 WHERE `combat`.`id_combat` = $combatid");

$playerjsonsend = array("targetcurrenthp"=>$target->getCurrentHealth(),"targetmaxhp"=>$target->getTotalHealth());
echo json_encode($playerjsonsend);






?>
