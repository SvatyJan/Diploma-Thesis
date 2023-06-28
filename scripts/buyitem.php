<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

$id = $_SESSION["id"];
$itemid = $_GET["itemid"];
$coinid = 1;
$cost = $_GET["cost"];
$itemslot = NULL;

$checkmoney = Select("SELECT * FROM characters_has_items WHERE Items_id_item = $coinid AND Characters_id_character = ?", $id, $conn)[0];
//echo $checkmoney["pocet"];
if ($checkmoney["pocet"] >= $cost) {
    //get item from db
    $getitem = Select("SELECT * FROM Items WHERE id_item = ?", $itemid, $conn)[0];
    $itemslot = $getitem["ItemSlots_id_ItemSlots"];
    $isconsumable = $getitem["isConsumable"];

    if ($isconsumable == 1) {

        $result = mysqli_query($conn, "SELECT * FROM characters_has_items WHERE Items_id_item = $itemid AND Characters_id_character = $id");
        $countitemininventory = mysqli_num_rows($result);
        echo $countitemininventory;

        if ($countitemininventory >= 1) {
            mysqli_query($conn, " UPDATE characters_has_items SET pocet=pocet+1 WHERE Items_id_item = $itemid AND Characters_id_character = $id");
            mysqli_query($conn, "UPDATE `characters_has_items` SET pocet = pocet-$cost WHERE Characters_id_character = $id AND Items_id_item = 1");
        } else {
            mysqli_query($conn, "INSERT INTO `characters_has_items` (`Characters_id_character`, `Items_id_item`, `Itemslots_id_itemslots`, `pocet`, `isEquipped`) 
VALUES ('$id', '$itemid', NULL, '1', '0')");
        }
    } else {
        //check if item is already in character inventory
        $result = mysqli_query($conn, "SELECT * FROM characters_has_items WHERE Items_id_item = $itemid AND Characters_id_character = $id");
        $countitemininventory = mysqli_num_rows($result);

        if ($countitemininventory >= 1) {
            mysqli_query($conn, " UPDATE characters_has_items SET pocet=pocet+1 WHERE Items_id_item = $itemid AND Characters_id_character = $id");
            mysqli_query($conn, "UPDATE `characters_has_items` SET pocet = pocet-$cost WHERE Characters_id_character = $id AND Items_id_item = 1");
        } else {
            //add item to invenotory
            mysqli_query($conn, "INSERT INTO `characters_has_items` (`Characters_id_character`, `Items_id_item`, `Itemslots_id_itemslots`, `pocet`, `isEquipped`) 
            VALUES ('$id', '$itemid', '$itemslot', '1', '0')");
            //remove gold
            mysqli_query($conn, "UPDATE `characters_has_items` SET pocet = pocet-$cost WHERE Characters_id_character = $id AND Items_id_item = 1");
        }
    }
} else {
    echo "Not enough money!";
}
header("Location:../index.php?pages=tavern");
?>