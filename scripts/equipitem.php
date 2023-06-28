<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

$id = $_SESSION["id"];
$itemid = $_GET["itemid"];

//check jestli je item consumable
$isconsumable = Select("SELECT * FROM items WHERE id_item = ?", $itemid, $conn)[0];
$consumable = $isconsumable["isConsumable"];
//echo $consumable;

if ($consumable == 1) {
    DrinkHealthPotion($id,$conn);
}
else{
//check jestli už ten itemslot je obsazený nebo ne
    $selectitem = Select("SELECT * FROM Characters_has_items WHERE Items_id_item = ? AND Characters_id_character = $id", $itemid, $conn)[0];
    $slotitemu = $selectitem["Itemslots_id_itemslots"];

//checknu jestli už mam na sobě item s timto slotem
    @$checkifequipped = Select("SELECT * FROM Characters_has_items WHERE isEquipped = 1 AND Characters_id_character = $id AND Itemslots_id_itemslots = ?", $slotitemu, $conn)[0];
    @$idequippeditem = $checkifequipped["Items_id_item"];

    if ($idequippeditem == "") {
        //updatnu item hráče v charcter has items
        $updateitem = "UPDATE `characters_has_items` SET `isEquipped` = '1' WHERE `characters_has_items`.`Characters_id_character` = $id 
    AND `characters_has_items`.`Items_id_item` = $itemid;";
        mysqli_query($conn, $updateitem);
        echo "Předmět oblečen.";
    } else {
        $updateitem = "UPDATE `characters_has_items` SET `isEquipped` = '0' WHERE `characters_has_items`.`Characters_id_character` = $id 
    AND `characters_has_items`.`Items_id_item` = $itemid;";
        mysqli_query($conn, $updateitem);
        echo "Již na sobě máte předmět!";
    }
}

header("Location: ../index.php?pages=profile&profilepage=inventory&id=$id");

?>