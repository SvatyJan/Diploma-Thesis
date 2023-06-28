<?php
include("../connect.php");
include("../functions.php");
require("../classes/monsterclass.php");
require("../classes/playerclass.php");
require("../classes/itemclass.php");
require("../classes/spellclass.php");

$playerjson = json_decode($_POST["json"]);

$playerjsonencode = array("playerid"=>$playerjson->{'playerid'});
$playerid = $playerjson->{'playerid'};

$getcombat = Select("SELECT * FROM Combat WHERE id_player = ? ",$playerid,$conn)[0];
$combatid = $getcombat["id_combat"];

mysqli_query($conn,"UPDATE `combat` SET `finished` = '1' WHERE `combat`.`id_combat` = $combatid");

$getcombatstate = Select("SELECT * FROM Combat WHERE id_player = ? ",$playerid,$conn)[0];
$iscombatfinished = $getcombatstate["finished"];

$playerjsonsend = array("combatstate"=>$iscombatfinished);
echo json_encode($playerjsonsend);






?>
