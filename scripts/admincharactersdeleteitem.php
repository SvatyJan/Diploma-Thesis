<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemid = $_GET["itemid"];
$characterid = $_GET["characterid"];

if ($_SESSION["rank"] == 2) {
    mysqli_query($conn,"DELETE FROM characters_has_items WHERE Characters_id_character = $characterid AND Items_id_item = $itemid");
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");

} else {
    Header("Location:../index.php?pages=main");
}
?>