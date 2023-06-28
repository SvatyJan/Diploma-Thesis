<?php
session_start();
include_once("../connect.php");

if(isset($_SESSION["id"])){

$iconid = $_GET["iconid"];
echo $iconid;

$id = $_SESSION["id"];
echo $id;

$sql = "UPDATE `characters` SET `Image_id_image` = $iconid WHERE `characters`.`id_character` = $id;";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location:../index.php?pages=profile&id=$id");
    } else {
        echo "Error updating record: " . $conn->error;
    }

}




?>