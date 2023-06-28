<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemid = $_GET["id"];

if ($_SESSION["rank"] == 2) {

    mysqli_query($conn,"DELETE FROM items WHERE id_item = $itemid");
    Header("Location:../index.php?pages=admin&adminpage=adminitems");
} else {
    Header("Location:../index.php?pages=main");
}

?>