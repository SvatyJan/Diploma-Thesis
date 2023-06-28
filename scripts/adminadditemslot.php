<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$itemslotname = $_POST["itemslotname"];
echo $itemslotname;

if ($_SESSION["rank"] == 2) {
    $doesitemslotexist = SELECT("SELECT * FROM itemslots WHERE slotname = ?",$itemslotname,$conn,"s");

    if(count($doesitemslotexist) === 0){
        mysqli_query($conn,"INSERT INTO itemslots (slotname) VALUES ('$itemslotname')");
    }
    Header("Location:../index.php?pages=admin&adminpage=adminitems");

} else {
    Header("Location:../index.php?pages=main");
}
?>