<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
$charactername = $_POST["charactername"];
$characterid = $_POST["characterid"];

echo $characterid;

if ($_SESSION["rank"] == 2) {
    //checkni jestli už to jmeno je v db
    //$isNameInDB = Select("SELECT * FROM characters WHERE username = ?",$charactername,$conn);
    $isNameInDB = mysqli_query($conn,"SELECT * FROM characters");

    foreach ($isNameInDB as $nameinDB) {
        if($charactername === $nameinDB["username"]){
            echo "Jméno je již zabrané!";
        }
        else{
            mysqli_query($conn,"UPDATE `characters` SET `username` = '$charactername' WHERE `characters`.`id_character` = $characterid;");
            Header("Location:../index.php?pages=admin&adminpage=admineditcharacter&id=$characterid");
        }
    }
} else {
    Header("Location:../index.php?pages=main");
}


?>