<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$racename = $_POST["racename"];

if($_SESSION["rank"] == 2){

    $shody = 0;
    $races = Select("Select * from race WHERE racename = ?",$racename,$conn);
    foreach ($races as $race){
        if($racename === $race["racename"]){
            $shody++;
        }
    }
    if($shody === 0){
        mysqli_query($conn,"INSERT INTO `race` (`racename`) VALUES ('$racename');");
    }
    Header("Location:../index.php?pages=admin&adminpage=admingeneral");
}
else{
    Header("Location:../index.php?pages=main");
}
?>
