<?php
include("../connect.php");
include("../functions.php");
require("../classes/monsterclass.php");
require("../classes/playerclass.php");
require("../classes/itemclass.php");
require("../classes/spellclass.php");

$playerjson = json_decode($_POST["json"]);

//$jsonencode = array("playerid"=>$json->{'playerid'}, "targetid"=>$json->{'targetid'}, "action"=>$json->{'action'});
$playerjsonencode = array("monsterid"=>$playerjson->{'monsterid'}, "targetid"=>$playerjson->{'targetid'}, "action"=>$playerjson->{'action'});

$monster = MonsterFactory::createMonster($playerjson->{'monsterid'});
$target = PlayerFactory::createPlayer($playerjson->{'targetid'});


$playerid = $monster->getId();
$targetid = $target->getId();

$getcombatid = Select("SELECT * FROM combat WHERE id_player = ?",$targetid,$conn)[0];
$combatid = $getcombatid["id_combat"];

$gettargethp = Select("SELECT * FROM combat_has_characters WHERE Characters_id_character = ?",$targetid,$conn)[0];
$hpzdb = $gettargethp["currentHealth"];
$target->setCurrentHealth($hpzdb);
$target->takeDamage($monster->getTotalDamage());
$newtargethp = $target->getCurrentHealth();


$settargethp = mysqli_query($conn,"UPDATE `combat_has_characters` SET `currentHealth` = $newtargethp
                             WHERE `combat_has_characters`.`Combat_id_combat` = $combatid AND `Combat_has_characters`.`characters_id_character` = $targetid");

//hraje další hráč
//$dalsihracnatahu = mysqli_query($conn,"UPDATE `combat` SET `hracvporadi` = 0 WHERE `combat`.`id_combat` = $combatid");

//$jsonsend = array("targetcurrenthp"=>60,"targetmaxhp"=>120);
//$jsonsend = array("targetcurrenthp"=>$target->getCurrentHealth(),"targetmaxhp"=>$target->getTotalHealth());
$playerjsonsend = array("targetcurrenthp"=>$target->getCurrentHealth(),"targetmaxhp"=>$target->getTotalHealth());
echo json_encode($playerjsonsend);






?>
