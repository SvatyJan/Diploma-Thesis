<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$spellslotid = $_GET["id"];
echo $spellslotid;

if ($_SESSION["rank"] == 2) {
    mysqli_query($conn,"DELETE FROM spellslots WHERE id_spellslots = $spellslotid");
    Header("Location:../index.php?pages=admin&adminpage=adminspells");

} else {
    Header("Location:../index.php?pages=main");
}
?>