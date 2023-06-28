<?php
require("../connect.php");
require("../functions.php");
$id = $_GET["id"];
$getcombatid = Select("SELECT * FROM Combat WHERE id_player = ?",$id,$conn)[0];
$combatid = $getcombatid["id_combat"];

$didplayerwin = Select("SELECT * FROM combat_has_characters WHERE Combat_id_combat = ? AND Characters_id_character = $id AND currentHealth > 0 ",$combatid,$conn);

if(count($didplayerwin) > 0){
    //nahodny predmet + nahodny pocet zlataku (10-50)
    $nahodnypocetzlataku = rand(10,50);
    $kolikjepredmetuvdb = mysqli_query($conn,"SELECT * FROM Items");


    mysqli_query($conn,"UPDATE `characters_has_items` SET `pocet` = pocet+$nahodnypocetzlataku WHERE `characters_has_items`.`Characters_id_character` = $id AND `characters_has_items`.`Items_id_item` = 1");
    $nahodnypredmet = NULL;
    //ošetření že ten item je v db
    do {
        $nahodnypredmet = rand(2,mysqli_num_rows($kolikjepredmetuvdb));
        echo $nahodnypredmet;
        $vjakemslotujeitem = Select("SELECT * FROM Items WHERE id_item = ?", $nahodnypredmet, $conn)[0];
        $itemslot = $vjakemslotujeitem["ItemSlots_id_ItemSlots"];
    } while (empty($vjakemslotujeitem));


    $mauzhracpredmet = mysqli_query($conn,"SELECT * FROM Characters_has_items WHERE Characters_id_character = $id AND Items_id_item = $nahodnypredmet");
    echo mysqli_num_rows($mauzhracpredmet);
    if(mysqli_num_rows($mauzhracpredmet) > 0){
        mysqli_query($conn,"UPDATE `characters_has_items` SET `pocet` = pocet+1 WHERE `characters_has_items`.`Characters_id_character` = $id AND `characters_has_items`.`Items_id_item` = $nahodnypredmet");
    }
    else{
        mysqli_query($conn,"INSERT INTO `characters_has_items` (`Characters_id_character`, `Items_id_item`, `Itemslots_id_itemslots`, `pocet`, `isEquipped`) VALUES ($id, $nahodnypredmet, $itemslot, '1', '0')");
    }

    $nahodnypocetxp = rand(10,30);
    $pridejxp = mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = value+$nahodnypocetxp WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 9");


}

mysqli_query($conn,"DELETE FROM combat WHERE `combat`.`id_combat` = $combatid AND `combat`.`id_player` = $id");
header("Location: ../index.php?pages=profile&id=$id");

?>