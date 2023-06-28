<?php
include_once("../connect.php");

$idrace = $_POST["idrace"];
$racename = $_POST["racename"];


echo $idimage.$oldfilename.$newfilename.$newalt;
$dotaz = mysqli_query($conn,"UPDATE `race` SET `racename` = '$racename' WHERE `race`.`id_race` = $idrace;");

Header("Location: ../index.php?pages=admin&adminpage=admingeneral");
?>
