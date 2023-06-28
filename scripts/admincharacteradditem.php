<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemname = $_POST["itemname"];
$characterid = $_POST["characterid"];
$amount = $_POST["amount"];

if ($_SESSION["rank"] == 2) {

    $iditemu = Select("SELECT * FROM items 
    LEFT JOIN itemslots ON items.ItemSlots_id_ItemSlots = itemslots.id_Itemslots    
WHERE itemname = ?", $itemname, $conn, "s")[0];
    $newiditemu = $iditemu["id_item"];
    $itemslotid = $iditemu["id_Itemslots"];

    $macharacteritems = Select("SELECT * FROM characters_has_items WHERE Items_id_item = ?", $newiditemu, $conn);
    $kolikmaitemu = 0;
    $pocetitemu = 0;

    foreach ($macharacteritems as $macharacteritem) {
        $kolikmaitemu++;
        $pocetitemu = $macharacteritem["pocet"];
    }
    $pocetitemu+=$amount;

    if ($kolikmaitemu > 0) {
        mysqli_query($conn, "UPDATE characters_has_items SET pocet='$pocetitemu' WHERE Items_id_item = $newiditemu AND Characters_id_character = $characterid ");
    }
    else{
        mysqli_query($conn,"INSERT INTO `characters_has_items` 
    (`Characters_id_character`, `Items_id_item`, `Itemslots_id_itemslots`, `pocet`, `isEquipped`)
 VALUES ($characterid, $newiditemu, $itemslotid, $amount, '0')");
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");


} else {
    Header("Location:../index.php?pages=main");
}
?>