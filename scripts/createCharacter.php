<!DOCTYPE html>
<head>
    <title>BP Vývoj herní databáze</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div class="charactercreation">
<?php
require("../connect.php");

$username 	= htmlspecialchars($_POST["charname"]);
$raceid 	= htmlspecialchars($_POST["race"]);
$password 	= md5(htmlspecialchars($_POST["password"]));
$passwordagain 	= md5(htmlspecialchars($_POST["passwordagain"]));

//později opravit lepší zabezpečení (hash256)

$defaulticon = "default.png";
$rankid = 2;
$locationid = 0;
$jednicka = 1;

//check if registered
$checkifregistered = mysqli_query($conn,"SELECT username FROM Characters WHERE username = '$username'");
if(mysqli_num_rows($checkifregistered) > 0){
    echo "This Username already exists!.<br>";

}
else{
    echo "You have been registered sucessfully.<br>";
}

if($password == $passwordagain){
    try {
        $dotaz = "INSERT INTO Characters (username,password,Race_id_race,Location_id_location,Rank_id_rank,Image_id_image) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("ssiiii", $username, $password, $raceid, $jednicka, $jednicka, $jednicka);
        $stmt->execute();
        $id=$stmt->insert_id;

        $itemid = 1;
        $itemslotid = NULL;
        $pocet = 100;

        //pridej 100 penez
        $dotaz = ("INSERT INTO Characters_has_Items (Characters_id_character, Items_id_item, Itemslots_id_itemslots, pocet) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$itemid,$itemslotid,$pocet);
        $stmt->execute();

        $itemid = 2;
        $itemslotid = 10;
        $pocet = 1;
        //pridej mec
        $dotaz = ("INSERT INTO Characters_has_Items (Characters_id_character, Items_id_item, Itemslots_id_itemslots, pocet) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$itemid,$itemslotid,$pocet);
        $stmt->execute();

        //pridej zakladni kouzla
        //Crushing Blow
        $spellid = 1;
        $spellslotid = 3;
        $vJakemJeSlotu = 0;
        $dotaz = ("INSERT INTO Characters_has_Spells (Characters_id_character, Spells_id_spells, Spellslots_id_spellslots, vJakemJeSlotu) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$spellid,$spellslotid,$vJakemJeSlotu);
        $stmt->execute();

        //Cloak of Shadows
        $spellid = 14;
        $spellslotid = 2;
        $vJakemJeSlotu = 0;
        $dotaz = ("INSERT INTO Characters_has_Spells (Characters_id_character, Spells_id_spells, Spellslots_id_spellslots, vJakemJeSlotu) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$spellid,$spellslotid,$vJakemJeSlotu);
        $stmt->execute();

        //Overload
        $spellid = 6;
        $spellslotid = 3;
        $vJakemJeSlotu = 0;
        $dotaz = ("INSERT INTO Characters_has_Spells (Characters_id_character, Spells_id_spells, Spellslots_id_spellslots, vJakemJeSlotu) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$spellid,$spellslotid,$vJakemJeSlotu);
        $stmt->execute();

        //Shiv
        $spellid = 10;
        $spellslotid = 3;
        $vJakemJeSlotu = 0;
        $dotaz = ("INSERT INTO Characters_has_Spells (Characters_id_character, Spells_id_spells, Spellslots_id_spellslots, vJakemJeSlotu) VALUES (?, ?, ?, ?)");
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("iiii", $id,$spellid,$spellslotid,$vJakemJeSlotu);
        $stmt->execute();
        
    } catch(mysqli_sql_exception $e){
        echo $e->getMessage();
    }
}
else{
    echo "Password and Second Password doesn't match!<br>";
}
//echo "<a href='../index.php?pages=main'>Continue.</a>";
header("Location:../index.php?pages=login");

?>
</div>
