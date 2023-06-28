<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellid = $_POST["itemid"];
$statname = $_POST["statname"];
$spolecnestatycounter = 0;

if ($_SESSION["rank"] == 2) {
    $statids = Select("SELECT * FROM stats WHERE statname = ?",$statname,$conn,"s")[0];
    $statid = $statids["id_stats"];

    $statcheck = mysqli_query($conn,"SELECT * from spells_has_stats WHERE Spells_id_spells = $spellid AND Stats_id_stats = $statid");
    if(mysqli_num_rows($statcheck) === 0){
        $additemstat = mysqli_query($conn,"INSERT INTO `spells_has_stats` (`Stats_id_stats`, `Spells_id_spells`, `value`) VALUES ('$statid', '$spellid', '1')");
    }
    Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
} else {
    Header("Location:../index.php?pages=main");
}
?>