<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $itemid = $_POST["itemid"];
    $description = $_POST["description"];

    mysqli_query($conn,"UPDATE `items` SET `Description` = '$description' WHERE `items`.`id_item` = $itemid");
    Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
} else {
    Header("Location:../index.php?pages=main");
}
?>