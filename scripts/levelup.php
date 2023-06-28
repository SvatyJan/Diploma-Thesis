<?php
include_once("../connect.php");
include_once("../functions.php");
session_start();

$id = $_SESSION["id"];
$xp = 0;
$level = 0;
$xpneeded = 1;

$getplayerxp = mysqli_query($conn,"SELECT * FROM `characters_has_stats` WHERE characters_id_character = $id");
if(mysqli_num_rows($getplayerxp) > 0){
    while($row = mysqli_fetch_assoc($getplayerxp)){
        $idstat = $row["Stats_id_stats"];
        if($idstat == 9){
            $xp = $row["value"];
        }
        if($idstat == 8){
            $level = $row["value"];
            $xpneeded = $level*50;
        }
    }
}

if($xp >= $xpneeded){
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = value+1 WHERE
 `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 8;");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = '0' WHERE 
`characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 9;");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+5
    WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 1");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+3
    WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 2");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+3
    WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 3");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+3
    WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 4");
    mysqli_query($conn,"UPDATE `characters_has_stats` SET `value` = `value`+1
    WHERE `characters_has_stats`.`Characters_id_character` = $id AND `characters_has_stats`.`Stats_id_stats` = 7");
}
header("Location: ../index.php?pages=profile&id=$id");


?>