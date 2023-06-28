<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$imagename = $_POST["image"];
$spellname = $_POST["spellname"];
$spellslot = $_POST["spellslot"];

echo $imagename.$spellname;

if ($_SESSION["rank"] == 2) {

    $iconid = Select("SELECT * FROM image WHERE source = ?",$imagename,$conn,"s")[0];
    $imageid = $iconid["id_image"];
    echo $imageid;

    $spellslotid = Select("SELECT * FROM spellslots WHERE spellslotname = ?",$spellslot,$conn,"s")[0];
    $slotid = $spellslotid["id_spellslots"];
    echo $slotid;

    mysqli_query($conn,"INSERT INTO spells (spellname,Image_id_image,Spellslots_id_spellslots) VALUES ('$spellname','$imageid','$slotid')");
    Header("Location:../index.php?pages=admin&adminpage=adminspells");
} else {
    Header("Location:../index.php?pages=main");
}

?>