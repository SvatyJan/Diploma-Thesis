<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemslotid = $_GET["id"];
echo $itemslotid;

if ($_SESSION["rank"] == 2) {
    mysqli_query($conn,"DELETE FROM itemslots WHERE id_Itemslots = $itemslotid");
    Header("Location:../index.php?pages=admin&adminpage=adminitems");

} else {
    Header("Location:../index.php?pages=main");
}
?>