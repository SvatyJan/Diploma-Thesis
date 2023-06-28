<?php
if(!(isset($_SESSION["login"]))){
    header("Location: index.php?pages=main");
}
require ("classes/playerclass.php");
require ("classes/itemclass.php");
require ("classes/spellclass.php");
$profileid = $_GET["id"];
$player = PlayerFactory::createPlayer($profileid);

include_once("profilemenu.php");
?>