<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterimage = $_POST["image"];
$monsterid = $_POST["monsterid"];

if ($_SESSION["rank"] == 2) {

    $idObrazku = SELECT("SELECT * FROM image WHERE source = ?",$monsterimage,$conn,"s")[0];
    $newidobrazku = $idObrazku["id_image"];

    mysqli_query($conn, "UPDATE `monsters` SET `Image_id_image` = $newidobrazku WHERE `monsters`.`id_monster` = $monsterid");
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");

} else {
    Header("Location:../index.php?pages=main");
}


