<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

$id = $_SESSION["id"];
$itemid = $_GET["itemid"];

echo $itemid;

$updateitem = "UPDATE `characters_has_items` SET `isEquipped` = '0' WHERE `characters_has_items`.`Characters_id_character` = $id AND
 `characters_has_items`.`Items_id_item` = $itemid";
mysqli_query($conn,$updateitem);

header("Location: ../index.php?pages=profile&id=$id");

?>