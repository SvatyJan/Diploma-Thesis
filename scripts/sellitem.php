<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");

$id = $_SESSION["id"];
$itemid = $_GET["itemid"];
$coinid= 1;
$cost = $_GET["cost"];


$getitem = mysqli_query($conn,"SELECT * FROM Characters_has_items WHERE Items_id_item = $itemid AND Characters_id_character = $id LIMIT 1");

if(mysqli_num_rows($getitem) > 0){
    while($row = mysqli_fetch_assoc($getitem)){
        $itempocet = $row["pocet"];

        if($itempocet > 1){
            //znič item
            mysqli_query($conn,"UPDATE `characters_has_items` SET pocet=pocet-1 WHERE Items_id_item = $itemid AND Characters_id_character = $id");
            //dej peníze
            mysqli_query($conn,"UPDATE Characters_has_items SET pocet = pocet+$cost WHERE items_id_item = $coinid AND characters_id_character = $id");

        }
        else{
            //znič item
            mysqli_query($conn,"DELETE FROM `characters_has_items` WHERE Items_id_item = $itemid AND Characters_id_character = $id");
            //dej peníze
            mysqli_query($conn,"UPDATE Characters_has_items SET pocet = pocet+$cost WHERE items_id_item = $coinid AND characters_id_character = $id");
        }
    }
}
header("Location:../index.php?pages=tavern");


?>