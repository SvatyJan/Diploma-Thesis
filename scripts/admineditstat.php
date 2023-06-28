<?php
include_once("../connect.php");

$idcharacter = $_POST["characterid"];
$statid = $_POST["statid"];
$statvalue = $_POST["statvalue"];

echo $idcharacter.$statid.$statvalue;

mysqli_query($conn, "UPDATE characters_has_stats SET value = $statvalue WHERE Characters_id_character = $idcharacter AND Stats_id_stats = $statid");

header("Location: ../index.php?pages=admin&adminpage=admineditcharacter&id=$idcharacter");
?>