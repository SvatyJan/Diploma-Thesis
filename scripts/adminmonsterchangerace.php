<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterid = $_POST["monsterid"];


if ($_SESSION["rank"] == 2) {
    $race = $_POST["race"];
    $getraceid = SELECT("SELECT * FROM race WHERE racename = ?",$race,$conn,"s")[0];
    $newraceid = $getraceid["id_race"];

    mysqli_query($conn, "UPDATE `monsters` SET `Race_id_race` = $newraceid WHERE `monsters`.`id_monster` = $monsterid");
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");
} else {
    Header("Location:../index.php?pages=main");
}
?>