<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$racename = $_POST["race"];
$characterid = $_POST["characterid"];

if ($_SESSION["rank"] == 2) {
    //$races = Select("SELECT * FROM race WHERE racename = ?",$racename,$conn)[0];
    $races = mysqli_query($conn,"SELECT * FROM RACE");
    foreach ($races as $race) {
        $newracename = $race["racename"];
        $newraceid = $race["id_race"];
        if($racename === $newracename){
            mysqli_query($conn,"UPDATE characters SET Race_id_race = $newraceid WHERE id_character = $characterid");
        }
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");
} else {
    Header("Location:../index.php?pages=main");
}


?>