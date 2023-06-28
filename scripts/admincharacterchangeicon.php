<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$characterimage = $_POST["image"];
$characterid = $_POST["characterid"];

if ($_SESSION["rank"] == 2) {
    $idObrazku = SELECT("SELECT * FROM image WHERE source = ?",$characterimage,$conn,"s")[0];
    $newidobrazku = $idObrazku["id_image"];

    mysqli_query($conn, "UPDATE characters SET Image_id_image = $newidobrazku WHERE id_character = $characterid");
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");

} else {
    Header("Location:../index.php?pages=main");
}


?>