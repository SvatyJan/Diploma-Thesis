<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemid = $_POST["itemid"];
$image = $_POST["image"];

if ($_SESSION["rank"] == 2) {
    $imageAtributes = Select("SELECT * FROM image WHERE source = ?", $image, $conn, "s")[0];
    print_r($imageAtributes);
    $newimage = $imageAtributes["id_image"];

    $setItemImage = mysqli_query($conn, "UPDATE items SET Image_id_image = $newimage WHERE id_item = $itemid");
    Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
} else {
    Header("Location:../index.php?pages=main");
}
?>