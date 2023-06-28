<?php
include_once("../connect.php");

$idimage = $_POST["idimage"];
$oldfilename = $_POST["oldfilename"];
$newfilename = $_POST["newfilename"];
$newalt = $_POST["newfilealt"];

echo $idimage.$oldfilename.$newfilename.$newalt;
$dotaz = mysqli_query($conn,"UPDATE `image` SET `source` = '$newfilename', `alt` = '$newalt' WHERE `image`.`id_image` = $idimage;");
rename("../icons/".$oldfilename,"../icons/".$newfilename);

Header("Location: ../index.php?pages=admin&adminpage=admingeneral");
?>
