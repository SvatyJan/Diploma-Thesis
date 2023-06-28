<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemid = $_POST["itemid"];
$statname = $_POST["statname"];
$spolecnestatycounter = 0;

if ($_SESSION["rank"] == 2) {
    $statids = Select("SELECT * FROM stats WHERE statname = ?",$statname,$conn,"s")[0];
    $statid = $statids["id_stats"];

    $statcheck = mysqli_query($conn,"SELECT * from items_has_stats WHERE Items_id_item = $itemid AND Stats_id_stats = $statid");
    if(mysqli_num_rows($statcheck) === 0){
        $additemstat = mysqli_query($conn,"INSERT INTO `items_has_stats` (`Stats_id_stats`, `Items_id_item`, `value`) VALUES ('$statid', '$itemid', '1')");
    }
    Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");


} else {
    Header("Location:../index.php?pages=main");
}
?>