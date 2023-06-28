<?php
session_start();
include("../connect.php");
$id = $_SESSION["id"];

$deletecombat = mysqli_query($conn,"DELETE FROM combat WHERE `combat`.`id_player` = $id");

header("Location: ../index.php");
?>