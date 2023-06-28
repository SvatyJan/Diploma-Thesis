<?php
include_once("../connect.php");
include_once("../functions.php");
session_start();
$sessionID = $_SESSION["id"];

$idHrace = $_GET["idhrace"];
$idkouzla = $_GET["idkouzla"];

//zjisti zda v tom slotu něco je
//když je, tak to setni na vJakemJeSlotu = 0

$isThereAnything = Select("SELECT * FROM Characters_has_spells WHERE Spells_id_spells = ? AND Characters_id_character = $sessionID LIMIT 1",$idkouzla,$conn);
foreach ($isThereAnything as $thereissomething){
    $vJakemJeSlotu = $thereissomething["vJakemJeSlotu"];
    if($vJakemJeSlotu > 0){
        //TADY OPTIMALIZOVAT NA PREPARED STATEMENT
        mysqli_query($conn,"UPDATE Characters_has_spells SET vJakemJeSlotu = 0 WHERE Spells_id_spells = $idkouzla AND Characters_id_character = $sessionID");
    }
}
header("Location: ../index.php?pages=profile&id=$sessionID&profilepage=spellbook");


?>