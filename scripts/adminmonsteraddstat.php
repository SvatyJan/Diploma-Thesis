<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$monsterid = $_POST["monsterid"];
$statname = $_POST["statname"];
$spolecnestatycounter = 0;

if ($_SESSION["rank"] == 2) {
    $statids = Select("SELECT * FROM stats WHERE statname = ?",$statname,$conn,"s")[0];
    $statid = $statids["id_stats"];

    $statcheck = mysqli_query($conn,"SELECT * from monsters_has_stats WHERE Monsters_id_monster = $monsterid AND Stats_id_stats = $statid");
    if(mysqli_num_rows($statcheck) === 0){
        $addmonsterstat = mysqli_query($conn,"INSERT INTO `monsters_has_stats` (`Stats_id_stats`, `Monsters_id_monster`, `value`) VALUES ('$statid', '$monsterid', '1')");
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditmonster&id=$monsterid");


} else {
    Header("Location:../index.php?pages=main");
}
?>