<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellid = $_GET["id"];

if ($_SESSION["rank"] == 2) {

    mysqli_query($conn,"DELETE FROM spells WHERE id_spells = $spellid");
    Header("Location:../index.php?pages=admin&adminpage=adminspells");
} else {
    Header("Location:../index.php?pages=main");
}

?>