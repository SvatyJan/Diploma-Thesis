<?php
include_once("../connect.php");
include_once("../functions.php");
session_start();
$sessionID = $_SESSION["id"];

$idHrace = $_GET["idhrace"];
$idkouzla = $_GET["idkouzla"];
$idSpellslot = $_GET["idSpellslot"];
$poradi = $_GET["poradi"];

//echo $idHrace.$idkouzla.$idSpellslot.$poradi;

//zjisti jestli je už něco v tom slotu a pořadí.
//vymaž to v tom slotu a pořadí (setni poradi na )
//setni dané kouzlo na pořadí

if($idHrace == $sessionID){
    $JeUzNecoVeSlotu = Select("SELECT * FROM Characters_has_spells WHERE Spellslots_id_spellslots = $idSpellslot AND vJakemJeSlotu = $poradi
AND Characters_id_character = ?", $idHrace,$conn);

    echo count($JeUzNecoVeSlotu);
    //nic neni v pořadí, můžu setnout tohle kouzlo na pořadá
    if(count($JeUzNecoVeSlotu) == 0){
        $PridejKouzlo = mysqli_query($conn, "UPDATE Characters_has_spells SET vJakemJeSlotu = $poradi WHERE
        Characters_id_character = $idHrace AND Spells_id_spells = $idkouzla AND Spellslots_id_spellslots = $idSpellslot");
      }//něco tam je, musim to nejdřív setnout na 0
    else{
        $VyndejStareKouzlo = mysqli_query($conn,"UPDATE Characters_has_spells SET vJakemJeSlotu = 0 WHERE
        Characters_id_character = $idHrace AND Spellslots_id_spellslots = $idSpellslot AND vJakemJeSlotu = $poradi");

        $PridejKouzlo = mysqli_query($conn, "UPDATE Characters_has_spells SET vJakemJeSlotu = $poradi WHERE
        Characters_id_character = $idHrace AND Spells_id_spells = $idkouzla AND Spellslots_id_spellslots = $idSpellslot");
    }
}
else{
    echo "Nepovolená akce!";
}

header("Location: ../index.php?pages=profile&id=$sessionID&profilepage=spellbook");




?>