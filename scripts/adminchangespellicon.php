<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellid = $_POST["spellid"];
$image = $_POST["image"];


if ($_SESSION["rank"] == 2) {
    $imageAtributes = Select("SELECT * FROM image WHERE source = ?", $image, $conn, "s")[0];
    $newimage = $imageAtributes["id_image"];

    $setSpellImage = mysqli_query($conn, "UPDATE spells SET Image_id_image = $newimage WHERE id_spells = $spellid");
    Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
} else {
    Header("Location:../index.php?pages=main");
}
?>