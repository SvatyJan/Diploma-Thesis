<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $itemid = $_GET["itemid"];
    $statid = $_GET["statid"];
    echo $itemid . $statid;

    mysqli_query($conn,"DELETE FROM items_has_stats WHERE Stats_id_stats = $statid AND Items_id_item = $itemid");
    Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
} else {
    Header("Location:../index.php?pages=main");
}
?>