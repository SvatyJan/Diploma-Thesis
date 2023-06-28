<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$imagename = $_POST["image"];
$itemname = $_POST["itemname"];

if ($_SESSION["rank"] == 2) {

$iconid = Select("SELECT * FROM image WHERE source = ?",$imagename,$conn,"s")[0];
$imageid = $iconid["id_image"];
echo $imageid;

mysqli_query($conn,"INSERT INTO items (itemname,Image_id_image) VALUES ('$itemname','$imageid')");
    Header("Location:../index.php?pages=admin&adminpage=adminitems");
} else {
    Header("Location:../index.php?pages=main");
}

?>