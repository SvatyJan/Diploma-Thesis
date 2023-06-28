<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellslotname = $_POST["spellslotname"];
echo $spellslotname;

if ($_SESSION["rank"] == 2) {
    $doesspellslotnameexist = SELECT("SELECT * FROM spellslots WHERE spellslotname = ?",$spellslotname,$conn,"s");

    if(count($doesspellslotnameexist) === 0){
        mysqli_query($conn,"INSERT INTO spellslots (spellslotname) VALUES ('$spellslotname')");
    }
    Header("Location:../index.php?pages=admin&adminpage=adminspells");

} else {
    Header("Location:../index.php?pages=main");
}
?>