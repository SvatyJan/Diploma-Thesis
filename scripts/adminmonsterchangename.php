<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterid = $_POST["monsterid"];


if ($_SESSION["rank"] == 2) {
    $monstername = $_POST["monstername"];

    $doesmonsternameexists = SELECT("SELECT * FROM monsters WHERE monster_name = ?",$monstername,$conn,"s");

    if(count($doesmonsternameexists) == 0){
        mysqli_query($conn, "UPDATE `monsters` SET `monster_name` = '$monstername' WHERE `monsters`.`id_monster` = $monsterid");
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>