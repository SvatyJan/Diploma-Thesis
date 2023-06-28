<?php
session_start();
include_once("../connect.php");
include_once("../functions.php");
@$name = $_GET["name"];
@$stat = $_GET["stat"];
$spellid = $_POST["spellid"];


if ($_SESSION["rank"] == 2) {
    if (isset($name)) {
        $samenamecounter = 0;
        $spellname = $_POST["spellname"];

        $spellHasNames = mysqli_query($conn, "SELECT * FROM spells");
        foreach ($spellHasNames as $spellHasName) {
            $dbspellname = $spellHasName["spellname"];
            if ($spellname === $dbspellname) {
                $samenamecounter++;
            }
        }

        if ($samenamecounter == 0) {
            mysqli_query($conn, "UPDATE `spells` SET `spellname` = '$spellname' WHERE `spells`.`id_spells` = $spellid;");
            Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
        }
    }
    if(isset($stat)){
        $statid = $_POST["statid"];
        $statvalue = $_POST["statvalue"];

        echo $statid.$statvalue;
        mysqli_query($conn, "UPDATE `spells_has_stats` SET `value` = '$statvalue' WHERE `spells_has_stats`.`Spells_id_spells` = $spellid 
  AND `spells_has_stats`.`Stats_id_stats` = $statid;");
        Header("Location:../index.php?pages=admin&adminpage=admineditspell&id=$spellid");
    }

} else {
    Header("Location:../index.php?pages=main");
}
?>