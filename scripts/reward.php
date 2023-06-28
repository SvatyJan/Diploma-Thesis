<?php
include_once("../connect.php");
include_once("../functions.php");
session_start();

$id = $_SESSION["id"];

$player = SelectAllPlayer($id,$conn);

$xpgain = rand(10,20) + 5*$player[10];
$goldgain = rand(10,20) + 5*$player[10];
echo $xpgain.$goldgain;

mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+$xpgain WHERE
 `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 9;");

mysqli_query($conn,"UPDATE `characters_has_items` SET `pocet` = `pocet`+$goldgain WHERE
 `characters_has_items`.`Characters_id_character` = $id AND `characters_has_items`.`Items_id_item` = 1;");

header("Location:../index.php?pages=profile&id=$id");
?>