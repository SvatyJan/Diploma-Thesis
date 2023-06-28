<?php
function Select($dotaz,$parametr,$conn, $type="i"){
    $stmt = $conn->prepare($dotaz);
    $stmt->bind_param($type,$parametr);
    $stmt->execute();

    $result = $stmt->get_result();
    $results = array();
    while($row =$result->fetch_assoc()){
        array_push($results,$row);
    }
    return $results;
}

function Insert($dotaz,$parametr,$conn){
    $stmt = $conn->prepare($dotaz);
    $stmt->bind_param("i",$parametr);
    $stmt->execute();
}

function SelectAllPlayer($playerid, $conn, $type="i"){
    $player = array();

    $hrac = Select("SELECT * FROM Characters
    LEFT JOIN Image ON Image_id_image = Image.id_image
    WHERE id_character = ?", $playerid, $conn)[0];

    $staty = Select("SELECT * FROM Characters_has_Stats 
    LEFT JOIN Stats ON id_stats = Characters_has_Stats.Stats_id_stats
    WHERE Characters_id_character = ?", $playerid, $conn);

    $itemstaty = Select("SELECT * FROM Characters_has_Items LEFT JOIN Items_has_Stats ON 
    Characters_has_Items.Items_id_item = Items_has_Stats.Items_id_item WHERE Characters_id_character = ? AND isEquipped = 1", $playerid,$conn);

    foreach ($staty as $stat) {
        if ($stat['statname'] == "health") {
            $p1health = $stat['value'];
        }
        if ($stat['statname'] == "strength") {
            $p1str = $stat['value'];
        }
        if ($stat['statname'] == "agility") {
            $p1agi = $stat['value'];
        }
        if ($stat['statname'] == "intelligence") {
            $p1int = $stat['value'];
        }
        if ($stat['statname'] == "armor") {
            $p1armor = $stat['value'];
        }
        if ($stat['statname'] == "magic resist") {
            $p1mr = $stat['value'];
        }
        if ($stat['statname'] == "damage") {
            $p1damage = $stat['value'];
        }
        if ($stat['statname'] == "level") {
            $p1level = $stat['value'];
        }
    }

    foreach ($itemstaty as $statyitemu){
        $iditemstatu = $statyitemu["Stats_id_stats"];
        $valueitemstatu = $statyitemu["value"];

        if($iditemstatu == 1){$p1health = $p1health + $valueitemstatu;}
        if($iditemstatu == 2){$p1str = $p1str + $valueitemstatu;}
        if($iditemstatu == 3){$p1agi = $p1agi + $valueitemstatu;}
        if($iditemstatu == 4){$p1int = $p1int + $valueitemstatu;}
        if($iditemstatu == 5){$p1armor = $p1armor + $valueitemstatu;}
        if($iditemstatu == 6){$p1mr = $p1mr + $valueitemstatu;}
        if($iditemstatu == 7){$p1damage = $p1damage + $valueitemstatu;}
    }

    $playername = $hrac["username"];
    $playerimg = "icons/".$hrac["source"];

    //id,name,level,image,hp,str,agi,int,armor,mr,dmg
    array_push($player, $playerid, $playername, $playerimg,$p1health,$p1str,$p1agi,$p1int,$p1armor,$p1mr,$p1damage,$p1level);
    return $player;
}

function SelectAllMonster($monsterid,$conn){
    $monster = array();
    $monsterimg = 0;
    $mhealth = 0;
    $mstr = 0;
    $magi =0;
    $mint = 0;
    $marmor = 0;
    $mmr = 0;
    $mdamage = 0;

    $monsterselect = Select("SELECT * FROM Monsters LEFT JOIN Image ON Image_id_image = Image.id_image WHERE id_monster = ?", $monsterid, $conn)[0];

    $statymonstra = Select("SELECT * FROM Monsters_has_Stats LEFT JOIN Stats ON Monsters_has_Stats.Stats_id_stats = id_stats WHERE Monsters_id_monster = ?",
        $monsterid, $conn);

    foreach ($statymonstra as $statmonstra) {
        if ($statmonstra['statname'] == "health") {
            $mhealth = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "strength") {
            $mstr = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "agility") {
            $magi = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "intelligence") {
            $mint = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "armor") {
            $marmor = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "magic resist") {
            $mmr = $statmonstra['value'];
        }
        if ($statmonstra['statname'] == "damage") {
            $mdamage = $statmonstra['value'];
        }
    }
    $monstername = $monsterselect["monster_name"];
    $monsterimg = "icons/".$monsterselect["source"];

    //id,name,,img,hp,str,agi,nt,armor,mr,dmg
    array_push($monster, $monsterid, $monstername, $monsterimg,$mhealth,$mstr,$magi,$mint,$marmor,$mmr,$mdamage);

    return $monster;
}

function DrinkHealthPotion($playerid,$conn){

    //kolik potionu mam?
    $howmanyihave = mysqli_query($conn,"SELECT * FROM Characters_has_Items WHERE Characters_id_character = $playerid AND Items_id_item = 39 LIMIT 1");


    foreach ($howmanyihave as $item){
        $pocet = $item["pocet"];
        if($pocet > 1){
            mysqli_query($conn,"UPDATE Characters_has_Items SET pocet = pocet-1 WHERE Characters_id_character = $playerid AND Items_id_item = 39");
            mysqli_query($conn,"UPDATE Characters_has_Stats SET value = value+5 WHERE Characters_id_character = $playerid AND Stats_id_stats = 1");
        }
        elseif ($pocet == 1){
            mysqli_query($conn,"DELETE FROM Characters_has_Items WHERE Characters_id_character = $playerid AND Items_id_item = 39");
            mysqli_query($conn,"UPDATE Characters_has_Stats SET value = value+5 WHERE Characters_id_character = $playerid AND Stats_id_stats = 1");
        }
        else{
            echo "you don't have potion!";
        }
    }




}