<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monstername = $_POST["monstername"];
$racename = $_POST["racename"];

if ($_SESSION["rank"] == 2) {
    $getraceid = SELECT("SELECT * from race WHERE racename = ?",$racename,$conn,"s")[0];
    $raceid = $getraceid["id_race"];

    $doesmonsternameexists = SELECT("SELECT * FROM monsters WHERE monster_name = ?",$monstername,$conn,"s");

    if(count($doesmonsternameexists) == 0){
        mysqli_query($conn,"INSERT INTO `monsters` (`monster_name`, `Race_id_race`, `Image_id_image`) VALUES ('$monstername', '$raceid', '1')");
    }
    Header("Location:../index.php?pages=admin&adminpage=adminmonsters");

} else {
    Header("Location:../index.php?pages=main");
}
?>