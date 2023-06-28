<?php
if(!(isset($_SESSION["login"]))){
    header("Location: index.php?pages=main");
}

$hrac = Select("SELECT * FROM Characters
        LEFT JOIN Image ON Image_id_image = Image.id_image
        WHERE id_character = ?", $_GET["id"], $conn)[0];
//print_r($hrac);

$hisid = $hrac['id_character'];

$staty = Select("SELECT * FROM Characters_has_Stats 
LEFT JOIN Stats ON id_stats = Characters_has_Stats.Stats_id_stats
WHERE Characters_id_character = ?", $_GET["id"], $conn);
//print_r($staty[0]);

$health = $staty[0]["value"];
$str = $staty[1]["value"];
$agi = $staty[2]["value"];
$int = $staty[3]["value"];
$armor = $staty[4]["value"];
$mr = $staty[5]["value"];
$dmg = $staty[6]["value"];
$level = $staty[7]["value"];
$xp = $staty[8]["value"];
$nextlevelxp = 50 * $level;

$itemstaty = Select("SELECT * FROM characters_has_items LEFT JOIN items_has_stats ON 
characters_has_items.Items_id_item = items_has_stats.Items_id_item LEFT JOIN items ON
characters_has_items.Items_id_item = items.id_item WHERE Characters_id_character = ? AND isEquipped = 1", $_GET["id"], $conn);
//print_r($itemstaty);

foreach ($itemstaty as $statyitemu) {
    $iditemstatu = $statyitemu["Stats_id_stats"];
    $valueitemstatu = $statyitemu["value"];

    if ($iditemstatu == 1) {
        $health = $health + $valueitemstatu;
    }
    if ($iditemstatu == 2) {
        $str = $str + $valueitemstatu;
    }
    if ($iditemstatu == 3) {
        $agi = $agi + $valueitemstatu;
    }
    if ($iditemstatu == 4) {
        $int = $int + $valueitemstatu;
    }
    if ($iditemstatu == 5) {
        $armor = $armor + $valueitemstatu;
    }
    if ($iditemstatu == 6) {
        $mr = $mr + $valueitemstatu;
    }
    if ($iditemstatu == 7) {
        $dmg = $dmg + $valueitemstatu;
    }
}

$raceid = $hrac['Race_id_race'];
$race = Select("SELECT * FROM race WHERE id_race = ?", $raceid, $conn)[0];
//print_r($race);

$itemy = Select("SELECT * FROM Items 
LEFT JOIN Characters_has_Items ON id_item = Characters_has_Items.Items_id_item 
LEFT JOIN Image ON Items.Image_id_image = Image.id_image
LEFT JOIN itemslots ON itemslots.id_itemslots = characters_has_items.itemslots_id_itemslots
WHERE Characters_id_character = ?", $hisid, $conn);
//print_r($itemy);

$headsloticon = "icons/head-slot.png";
$chestsloticon = "icons/chest-slot.png";
$legssloticon = "icons/legs-slot.png";
$feetsloticon = "icons/feet-slot.png";
$necksloticon = "icons/neck-slot.png";
$beltsloticon = "icons/belt-slot.png";
$ringsloticon = "icons/ring-slot.png";
$trinketsloticon = "icons/trinket-slot.png";
$righthandsloticon = "icons/right-hand.png";
$lefthandsloticon = "icons/left-hand.png";

$headslot = NULL;
$chestslot = NULL;
$legsslot = NULL;
$feetslot = NULL;
$neckslot = NULL;
$beltslot = NULL;
$ringslot = NULL;
$trinketslot = NULL;
$righthandslot = NULL;
$lefthandslot = NULL;

foreach ($itemy as $item) {
    if ($item["isEquipped"] == 1) {
        if ($item["Itemslots_id_itemslots"] == 1) {
            $headsloticon = "icons/" . $item["source"];
            $headslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 2) {
            $chestsloticon = "icons/" . $item["source"];
            $chestslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 3) {
            $legssloticon = "icons/" . $item["source"];
            $legsslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 4) {
            $feetsloticon = "icons/" . $item["source"];
            $feetslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 5) {
            $necksloticon = "icons/" . $item["source"];
            $neckslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 6) {
            $beltsloticon = "icons/" . $item["source"];
            $beltslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 7) {
            $ringsloticon = "icons/" . $item["source"];
            $ringslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 8) {
            $trinketsloticon = "icons/" . $item["source"];
            $trinketslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 9) {
            $righthandsloticon = "icons/" . $item["source"];
            $righthandslot = $item["id_item"];
        }
        if ($item["Itemslots_id_itemslots"] == 10) {
            $lefthandsloticon = "icons/" . $item["source"];
            $lefthandslot = $item["id_item"];
        }
    }
}
include_once("profilemenu.php");
?>



