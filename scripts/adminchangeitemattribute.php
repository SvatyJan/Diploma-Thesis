<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
@$name = $_GET["name"];
@$value = $_GET["value"];
@$stat = $_GET["stat"];
@$delete = $_GET["delete"];
@$type = $_GET["type"];
$itemid = $_POST["itemid"];


if ($_SESSION["rank"] == 2) {
    if (isset($name)) {
        //echo "changing name";
        $samenamecounter = 0;
        $itemname = $_POST["itemname"];

        //je uz nejaky item takhle pojmenovany?
        $itemHasNames = mysqli_query($conn, "SELECT * FROM items");
        foreach ($itemHasNames as $itemHasName) {
            $dbitemname = $itemHasName["itemname"];
            if ($itemname === $dbitemname) {
                $samenamecounter++;
            }
        }
        if ($samenamecounter === 0) {
            mysqli_query($conn, "UPDATE `items` SET `itemname` = '$itemname' WHERE `items`.`id_item` = $itemid;");
            Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
        }
    }

    if (isset($value)) {
        //echo "changing value";
        $itemvalue = $_POST["itemvalue"];
        mysqli_query($conn, "UPDATE `items` SET `value` = '$itemvalue' WHERE `items`.`id_item` = $itemid;");
        Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
    }
    if (isset($stat)) {
        //echo "changing stat";
        $statvalue = $_POST["statvalue"];
        $statid = $_POST["statid"];
        //echo "Předmětu s id ".$itemid." Se mění stat s id ".$statid." na hodnotu ".$statvalue;
        mysqli_query($conn, "UPDATE items_has_stats SET value = $statvalue WHERE Items_id_item = $itemid AND Stats_id_stats = $statid");
        Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
    }
    if (isset($type)) {
        $isWeapon = $_POST["isWeapon"] ?? "off";
        $isConsumalbe = $_POST["isConsumalbe"] ?? "off";
        $isEquippable = $_POST["isEquippable"] ?? "off";

        if ($isWeapon === "on") {
            mysqli_query($conn, "UPDATE `items` SET `isWeapon` = '1' WHERE `items`.`id_item` = $itemid;");
        } else {
            mysqli_query($conn, "UPDATE `items` SET `isWeapon` = '0' WHERE `items`.`id_item` = $itemid;");
        }
        if ($isConsumalbe === "on") {
            mysqli_query($conn, "UPDATE `items` SET `isConsumable` = '1' WHERE `items`.`id_item` = $itemid;");
        } else {
            mysqli_query($conn, "UPDATE `items` SET `isConsumable` = '0' WHERE `items`.`id_item` = $itemid;");
        }
        if ($isEquippable === "on") {
            mysqli_query($conn, "UPDATE `items` SET `isEquippable` = '1' WHERE `items`.`id_item` = $itemid;");
        } else {
            mysqli_query($conn, "UPDATE `items` SET `isEquippable` = '0' WHERE `items`.`id_item` = $itemid;");
        }
        Header("Location:../index.php?pages=admin&adminpage=adminedititem&id=$itemid");
    }
} else {
    Header("Location:../index.php?pages=main");
}
?>