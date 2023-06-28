<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

if ($_SESSION["rank"] == 2) {
    $spellid = $_POST["spellid"];
    $description = $_POST["description"];

    mysqli_query($conn,"UPDATE `spells` SET `Description` = '$description' WHERE `spells`.`id_spells` = $spellid;");
    Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
} else {
    Header("Location:../index.php?pages=main");
}
?>