<?php
session_start();
include_once("../connect.php");
$imgid = $_GET["imgid"];

if($_SESSION["rank"] == 2){
    //delete file with that name
    $filename = "../icons/";
    $unlink = "";
    $fileNameToDestroy = mysqli_query($conn,"SELECT * FROM image where id_image = $imgid LIMIT 1");
    foreach ($fileNameToDestroy as $filetodestroy){
        $filesrc = $filetodestroy["source"];
        $unlink = $filename.$filesrc;
    }
    unlink($unlink);
    mysqli_query($conn,"DELETE FROM `image` WHERE `image`.`id_image` = $imgid");
    Header("Location:../index.php?pages=admin&adminpage=admingeneral");
}
else{
    Header("Location:../index.php?pages=main");
}
?>
