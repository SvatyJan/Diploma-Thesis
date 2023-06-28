<?php
/*
* Potřebuju vytvořit template pro combat. Tam budou 2 strany pro 2 týmy. (Template)
* následně vytvořit třídu, která bude tvořit instance na základě údajů s databáze. (Scripts)
* dále vytvořit šablonu kartičky hráče, kde se budou cpát proměnné z instance třídy hráče. (Template)
*
* krok 1. zavolat instance třídy do kartičky hráče
* krok 2. zavolat kartičku hráče do combat.php template
* krok 3. vyzkoušet funkcionalitu
*
*
* currentHealth atribut v db je zbytečný. Bude se načítat maximální zdraví hráče z databáze a to se ukládá v session. Po combatu se session zničí.
* */

//asi začnu od znova. Potřebuju nejdřív zjistit kdo vlastně je v tom souboji z db. Tým 0 a tým 1.
//Pak na základě jednotlivých hráčů potřebuju jejich ikonky, jména, staty, předměty a staty předmětů (posčítat)
//poté získat kouzla hráčů a jejich ikonky. Pak na kouzla udělat funkce(nějaké basic kam se dohodí jen jméno kouzla a staty kouzla)
//po získání proměnných z db udělat on click funkce, které budou mít real time interakci. (click na kouzlo = držíš spell)
//click na protihráče (pouze s kouzlem) = zaúčtočíš na protihráče a ukončíš své kolo
//Hrát se bude po tazích a v každém týmu je pořadí táhnoucích hráčů.
//Pokud všichni hráči z týmu mají pod 1 životu, tak prohráli. hráč který má pod 1 životů nemůže hrát.


/*
* Doctrine - db framework pro práci s db - object relation mapping
* data access layer - rozdelit vrstvu práce s db od logických vrstev
* sémentika - rozdělit kód v rámci tříd, které spolu souvisí a bloky, které jsou zvlášť
* namespace, class
*
* v rámci práce psát jak, by aplikace v ideálním případě měla být
* */

$id1 = $_SESSION['id'] ?? false;
$id2 = $_GET["id"] ?? false;

//nactu vsechno z prvniho hrace
//id,name,image,hp,str,agi,int,armor,mr,dmg
$player1 = SelectAllPlayer($id1,$conn);
//print_r($player1);

if($id2 != false){
    //nactu vsechno z druheho hrace
    $player2 = SelectAllPlayer($id2,$conn);
    //print_r($player2);

}
else{
    //nactu priseru
    $idmonstra = 1;
    $player2 = SelectAllMonster($idmonstra,$conn);
    //print_r($player2);
}

?>
<main class="main">
    <div class="combat-container">
        <div class="combat-player1">
            <img class="combat-player-image" src="<?= $player1[2]; ?>" alt="Profile Icon">
            <br>
            <?= $player1[1]; ?>
            <!-- <div class="combat-player-healthbar"> <?= $player1[3]; ?></div> --!>

            <?php
            echo "<div class='profile-stat'>"."Health : ".$player1[3]."</div>";
            echo "<div class='profile-stat'>"."Strength : ".$player1[4]."</div>";
            echo "<div class='profile-stat'>"."Agility : ".$player1[5]."</div>";
            echo "<div class='profile-stat'>"."Intelligence : ".$player1[6]."</div>";
            echo "<div class='profile-stat'>"."Armor : ".$player1[7]."</div>";
            echo "<div class='profile-stat'>"."Magic resist : ".$player1[8]."</div>";
            echo "<div class='profile-stat'>"."Damage : ".$player1[9]."</div>";
            ?>
        </div>
        <div class="combat-player2">
            <img class="combat-player-image" src="<?= $player2[2]; ?>" alt="Profile Icon">
            <br>
            <?= $player2[1]; ?>
            <!-- <div class="combat-player-healthbar"> <?= $player2[3]; ?></div> --!>

            <?php
            echo "<div class='profile-stat'>"."Health : ".$player2[3]."</div>";
            echo "<div class='profile-stat'>"."Strength : ".$player2[4]."</div>";
            echo "<div class='profile-stat'>"."Agility : ".$player2[5]."</div>";
            echo "<div class='profile-stat'>"."Intelligence : ".$player2[6]."</div>";
            echo "<div class='profile-stat'>"."Armor : ".$player2[7]."</div>";
            echo "<div class='profile-stat'>"."Magic resist : ".$player2[8]."</div>";
            echo "<div class='profile-stat'>"."Damage : ".$player2[9]."</div>";
            ?>
        </div>
        <div class="combat-text">
            <?php
            //zautoci hrac 1; da dmg do hrace 2; je hrac 2 mrtev? ne -> jedem dal
            //zautoci hrac 2; da dmg do hrace 1; je hrac 1 mrtev? ano -> konec cyklu
            $pocetcyklu = 0;

            while($pocetcyklu <= 10){
                //echo "$pocetcyklu"."<br>";

                echo "$player1[1] attacks $player2[1] and deals "." $player1[9]"." damage."."<br>";
                $player2[3] = $player2[3]-$player1[9];
                echo "$player2[1] has ".$player2[3]." health"."<br>";
                if($player2[3] <= 0){echo $player2[1]." died."."<br><a href=''>Get Reward!</a>";break;}

                echo "$player2[1] attacks $player1[1] and deals "." $player2[9]"." dammge."."<br>";
                $player1[3]= $player1[3]-$player2[9];
                echo "$player1[1] has ".$player1[3]." health."."<br>";
                if($player1[3] <= 0){echo $player1[1]." died.";break;}
                echo "<br>";
                $pocetcyklu++;
            }

            ?>
        </div>

    </div>
    <?php

    /*  ZALOHA KODU */
    include_once("scripts/combatfunctions.php");

    if (!(isset($_SESSION["login"]))) {
        header("Location: index.php?pages=main");
    }
    /*
     * Potřebuju vytvořit template pro combat. Tam budou 2 strany pro 2 týmy. (Template)
     * následně vytvořit třídu, která bude tvořit instance na základě údajů s databáze. (Scripts)
     * dále vytvořit šablonu kartičky hráče, kde se budou cpát proměnné z instance třídy hráče. (Template)
     *
     * krok 1. zavolat instance třídy do kartičky hráče
     * krok 2. zavolat kartičku hráče do combat.php template
     * krok 3. vyzkoušet funkcionalitu
     *
     *
     * currentHealth atribut v db je zbytečný. Bude se načítat maximální zdraví hráče z databáze a to se ukládá v session. Po combatu se session zničí.
     * */



    //asi začnu od znova. Potřebuju nejdřív zjistit kdo vlastně je v tom souboji z db. Tým 0 a tým 1.
    //Pak na základě jednotlivých hráčů potřebuju jejich ikonky, jména, staty, předměty a staty předmětů (posčítat)
    //poté získat kouzla hráčů a jejich ikonky. Pak na kouzla udělat funkce(nějaké basic kam se dohodí jen jméno kouzla a staty kouzla)
    //po získání proměnných z db udělat on click funkce, které budou mít real time interakci. (click na kouzlo = držíš spell)
    //click na protihráče (pouze s kouzlem) = zaúčtočíš na protihráče a ukončíš své kolo
    //Hrát se bude po tazích a v každém týmu je pořadí táhnoucích hráčů.
    //Pokud všichni hráči z týmu mají pod 1 životu, tak prohráli. hráč který má pod 1 životů nemůže hrát.


    /*
     * Doctrine - db framework pro práci s db - object relation mapping
     * data access layer - rozdelit vrstvu práce s db od logických vrstev
     * sémentika - rozdělit kód v rámci tříd, které spolu souvisí a bloky, které jsou zvlášť
     * namespace, class
     *
     * v rámci práce psát jak, by aplikace v ideálním případě měla být
     * */


    //DrawCharacterCard($conn,1);

    //kdo je vůbec v souboji?
    $team1 = array();
    $team2 = array();

    $getcombatid = Select("SELECT * FROM combat 
LEFT JOIN Combat_has_Characters ON combat.id_combat = Combat_has_Characters.Combat_id_combat
WHERE Combat_has_Characters.Characters_id_character = ?", $id, $conn)[0];
    $combatid = $getcombatid["id_combat"];
    $finished = $getcombatid["finished"];
    $faze = $getcombatid["faze"];
    $hracvporadi = $getcombatid["hracvporadi"];
    $playingteam = $getcombatid["playingteam"];

    //když combat neexistuje, jdi na domovskou stránku
    if($getcombatid === null){
        header("Location: index.php?pages=main");
    }

    $playingplayers = mysqli_query($conn, "SELECT * FROM combat
LEFT JOIN combat_has_characters ON combat.id_combat = combat_has_characters.Combat_id_combat
WHERE combat.id_combat = $combatid");

    $playingmonsters = mysqli_query($conn, "SELECT * FROM combat
LEFT JOIN combat_has_monsters ON combat.id_combat = combat_has_monsters.Combat_id_combat
WHERE combat.id_combat = $combatid");

    foreach ($playingplayers as $player) {
        //id_character,username,id_race,racename,source,alt,
        //STATS(+itemstats)[health,strength,agility,intelligence,armor,magic resist, damage],
        //SPELLS[passive,first,second,third,ultimate] + spell images
        $allplayer = array();
        $playerid = $player["Characters_id_character"];
        $playerteam = $player["team"];

        $getplayerbasics = Select("SELECT * FROM characters
    LEFT JOIN race ON characters.Race_id_race = race.id_race
    LEFT JOIN image ON characters.Image_id_image = image.id_image
	WHERE characters.id_character = ?", $playerid, $conn)[0];

        $id_character = $getplayerbasics["id_character"];
        $charactername = $getplayerbasics["username"];
        $raceid = $getplayerbasics["id_race"];
        $racename = $getplayerbasics["racename"];
        $characterimgsrc = "icons/" . $getplayerbasics["source"];
        $characterimgalt = $getplayerbasics["alt"];

        $playerbasics = array();
        array_push($playerbasics, $id_character, $charactername, $raceid, $racename, $characterimgsrc, $characterimgalt);
        array_push($allplayer, $playerbasics);

        //selectni staty z předmětů hráče a staty hráče, pak je sečti a dej do array
        $getplayerstats = Select("SELECT * FROM characters_has_stats
    LEFT JOIN stats ON stats.id_stats = characters_has_stats.Stats_id_stats
    WHERE Characters_id_character = ?", $playerid, $conn);

        $playerstats = array();

        $health = 0;
        $strength = 0;
        $agility = 0;
        $intelligence = 0;
        $armor = 0;
        $magicresist = 0;
        $damage = 0;

        foreach ($getplayerstats as $getplayerstat) {
            $statname = $getplayerstat["statname"];
            $statvalue = $getplayerstat["value"];
            if ($statname === "health") {
                $health += $statvalue;
            }
            if ($statname === "strength") {
                $strength += $statvalue;
            }
            if ($statname === "agility") {
                $agility += $statvalue;
            }
            if ($statname === "intelligence") {
                $intelligence += $statvalue;
            }
            if ($statname === "armor") {
                $armor += $statvalue;
            }
            if ($statname === "magicresist") {
                $magicresist += $statvalue;
            }
            if ($statname === "damage") {
                $damage += $statvalue;
            }
        }

        $getplayeritemandstats = Select("SELECT * FROM Characters_has_items
        LEFT JOIN items_has_stats ON items_has_stats.Items_id_item = Characters_has_items.Items_id_item
        LEFT JOIN stats ON stats.id_stats = items_has_stats.Stats_id_stats
        WHERE Characters_has_items.Characters_id_character = ?", $playerid, $conn);

        foreach ($getplayeritemandstats as $getplayeritemandstat) {
            $statname = $getplayeritemandstat["statname"];
            $statvalue = $getplayeritemandstat["value"];
            $isequipped = $getplayeritemandstat["isEquipped"];

            if ($statname === "health" && $isequipped === 1) {
                $health += $statvalue;
            }
            if ($statname === "strength" && $isequipped === 1) {
                $strength += $statvalue;
            }
            if ($statname === "agility" && $isequipped === 1) {
                $agility += $statvalue;
            }
            if ($statname === "intelligence" && $isequipped === 1) {
                $intelligence += $statvalue;
            }
            if ($statname === "armor" && $isequipped === 1) {
                $armor += $statvalue;
            }
            if ($statname === "magicresist" && $isequipped === 1) {
                $magicresist += $statvalue;
            }
            if ($statname === "damage" && $isequipped === 1) {
                $damage += $statvalue;
            }
        }
        //id_character,username,id_race,racename,source,alt,
        //STATS(+itemstats)[health,strength,agility,intelligence,armor,magic resist, damage],
        //SPELLS[passive,first,second,third,ultimate] + spell images
        array_push($playerstats, $health, $strength, $agility, $intelligence, $armor, $magicresist, $damage);
        array_push($allplayer, $playerstats);

        $playerspells = array();
        $getplayerspells = Select("SELECT * FROM characters_has_spells
    LEFT JOIN spells ON characters_has_spells.Spells_id_spells = spells.id_spells
    LEFT JOIN image ON image.id_image = spells.Image_id_image
    LEFT JOIN spellslots ON spellslots.id_spellslots = spells.Spellslots_id_spellslots
    WHERE characters_has_spells.Characters_id_character = ?", $playerid, $conn);

        $passive = array();
        $first = array();
        $second = array();
        $third = array();
        $ultimate = array();

        foreach ($getplayerspells as $getplayerspell) {
            $spellid = $getplayerspell["id_spells"];
            $spellname = $getplayerspell["spellname"];
            $vjakemjeslotu = $getplayerspell["vJakemJeSlotu"];
            $spellimg = "icons/" . $getplayerspell["source"];
            $spellalt = $getplayerspell["alt"];
            $spellslotid = $getplayerspell["id_spellslots"];
            $spellslotname = $getplayerspell["spellslotname"];
            if ($spellslotname === "passive" && $vjakemjeslotu === 1) {
                array_push($passive, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 1) {
                array_push($first, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 2) {
                array_push($second, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 3) {
                array_push($third, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "ultimate" && $vjakemjeslotu === 1) {
                array_push($ultimate, $spellid, $spellname, $spellimg, $spellalt);
            }
        }

        array_push($playerspells, $passive, $first, $second, $third, $ultimate);
        array_push($allplayer, $playerspells);

        if ($playerteam == 0) {
            array_push($team1, $allplayer);
        } else if ($playerteam == 1) {
            array_push($team2, $allplayer);
        }

    }
    //print_r($team1);

    foreach ($playingmonsters as $monster) {
        $allmonster = array();
        $monsterid = $monster["Monsters_id_monster"];
        $monsterteam = $monster["team"];

        $getmonsterbasics = Select("SELECT * FROM monsters
    LEFT JOIN race ON monsters.Race_id_race = race.id_race
    LEFT JOIN image ON monsters.Image_id_image = image.id_image
	WHERE monsters.id_monster = ?", $monsterid, $conn)[0];

        $id_monster = $getmonsterbasics["id_monster"];
        $monstername = $getmonsterbasics["monster_name"];
        $raceid = $getmonsterbasics["id_race"];
        $racename = $getmonsterbasics["racename"];
        $monsterimgsrc = "icons/" . $getmonsterbasics["source"];
        $monsterimgalt = $getmonsterbasics["alt"];

        $monsterbasics = array();
        array_push($monsterbasics, $id_monster, $monstername, $raceid, $racename, $monsterimgsrc, $monsterimgalt);
        array_push($allmonster, $monsterbasics);

        $getmonsterstats = Select("SELECT * FROM monsters_has_stats
    LEFT JOIN stats ON stats.id_stats = monsters_has_stats.Stats_id_stats
    WHERE Monsters_id_monster = ?", $monsterid, $conn);

        $monsterstats = array();

        $health = 0;
        $strength = 0;
        $agility = 0;
        $intelligence = 0;
        $armor = 0;
        $magicresist = 0;
        $damage = 0;

        foreach ($getmonsterstats as $getmonsterstat) {
            $statname = $getmonsterstat["statname"];
            $statvalue = $getmonsterstat["value"];
            if ($statname === "health") {
                $health += $statvalue;
            }
            if ($statname === "strength") {
                $strength += $statvalue;
            }
            if ($statname === "agility") {
                $agility += $statvalue;
            }
            if ($statname === "intelligence") {
                $intelligence += $statvalue;
            }
            if ($statname === "armor") {
                $armor += $statvalue;
            }
            if ($statname === "magicresist") {
                $magicresist += $statvalue;
            }
            if ($statname === "damage") {
                $damage += $statvalue;
            }
        }

        array_push($monsterstats, $health, $strength, $agility, $intelligence, $armor, $magicresist, $damage);
        array_push($allmonster, $monsterstats);


        $monsterspells = array();
        $getmonsterspells = Select("SELECT * FROM monsters_has_spells
    LEFT JOIN spells ON monsters_has_spells.Spells_id_spells = spells.id_spells
    LEFT JOIN image ON image.id_image = spells.Image_id_image
    LEFT JOIN spellslots ON spellslots.id_spellslots = spells.Spellslots_id_spellslots
    WHERE monsters_has_spells.Monsters_id_monster = ?", $monsterid, $conn);

        $passive = array();
        $first = array();
        $second = array();
        $third = array();
        $ultimate = array();

        foreach ($getmonsterspells as $getmonsterspell) {
            $spellid = $getmonsterspell["id_spells"];
            $spellname = $getmonsterspell["spellname"];
            $vjakemjeslotu = $getmonsterspell["vJakemJeSlotu"];
            $spellimg = "icons/" . $getmonsterspell["source"];
            $spellalt = $getmonsterspell["alt"];
            $spellslotid = $getmonsterspell["id_spellslots"];
            $spellslotname = $getmonsterspell["spellslotname"];
            if ($spellslotname === "passive" && $vjakemjeslotu === 1) {
                array_push($passive, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 1) {
                array_push($first, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 2) {
                array_push($second, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "combat" && $vjakemjeslotu === 3) {
                array_push($third, $spellid, $spellname, $spellimg, $spellalt);
            }
            if ($spellslotname === "ultimate" && $vjakemjeslotu === 1) {
                array_push($ultimate, $spellid, $spellname, $spellimg, $spellalt);
            }
        }

        array_push($monsterspells, $passive, $first, $second, $third, $ultimate);
        array_push($allmonster, $monsterspells);

        if ($monsterteam == 0) {
            array_push($team1, $allmonster);
        } else if ($monsterteam == 1) {
            array_push($team2, $allmonster);
        }
    }

    print_r($team1);
    echo "<br>";
    print_r($team2);
    ?>
    <script>
        var selectedaction = 0;

        function kteryHracHraje(hracvporadi) {
            var playingteam = <?=$playingteam;?>;
            if(playingteam == 0){
                var div = document.getElementsByClassName("combat-wrap-top");
                console.log("prvni team hraje");
                div[hracvporadi].style.boxShadow = "0px 0px 30px 10px orange";
            }

            if(playingteam == 1){
                console.log("druhy team hraje");
                var div = document.getElementsByClassName("combat-wrap-bot");
                div[hracvporadi].style.boxShadow = "0px 0px 30px 10px orange";
            }
        }

        function AutoAttack(hracvporadi){
            selectedaction++;
            console.log(selectedaction);
            if(selectedaction === 1){
                var div = document.getElementsByClassName("combat-player-action");
                div[hracvporadi].style.boxShadow = "0px 0px 30px 10px orange";

                var kartahrace = document.getElementsByClassName("combat-wrap-top");
                kartahrace[hracvporadi].style.boxShadow = "0px 0px 0px 0px";
                selectedaction = 1;

                //rozsvit protivniky
                var protivnik = document.getElementsByClassName("combat-wrap-bot");
                protivnik[0].style.boxShadow = "0px 0px 30px 10px orange";
                SelectPlayer();
            }
            else{
                selectedaction = 0;
                var div = document.getElementsByClassName("combat-player-action");
                div[hracvporadi].style.boxShadow = "0px 0px 0px 0px orange";

                var protivnik = document.getElementsByClassName("combat-wrap-bot");
                protivnik[0].style.boxShadow = "0px 0px 0px 0px orange";
                kteryHracHraje(hracvporadi);
            }
        }

        function SelectPlayer(){
            if(selectedaction > 0){
                if(<?=$playingteam;?> === 0){
                    console.log("neco");
                    //make enemy team clickable

                    //after clicking the enemy do the dmg
                }
            }
        }
    </script>
    <div class="combat-interface-wrap">
        <div class="combat-interface-top">
            <!-- TEAM1 -->
            <?php
            for ($i = 0; $i < count($team1); $i++) {
                ?>
                <div class="combat-wrap-top">
                    <div class="combat-top">
                        <img class="combat-player-image" src="<?= $team1[$i][0][4] ?? "icons/default.png"; ?>"
                             alt="<?= $team1[$i][0][5] ?? "icons/default.png"; ?>">
                        <div class="combat-player-name"><?= $team1[$i][0][1] ?? "Player"; ?></div>
                        <div class="combat-healtbar">
                            <div id="combat-bar" class="combat-bar"></div>
                        </div>
                    </div>
                    <div class="combat-bot">
                        <div class="combat-bot-upper-actions">
                            <img class="combat-player-action" onclick="AutoAttack(<?= $hracvporadi; ?>)" src="icons/broadsword.png" alt="icons/broadsword.png">
                            <img class="combat-player-action" src="<?= $team1[$i][2][0][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="icons/viking-shield.png" alt="icons/viking-shield.png">
                        </div>
                        <div class="combat-bot-spells">
                            <img class="combat-player-action" src="<?= $team1[$i][2][1][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team1[$i][2][2][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team1[$i][2][3][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team1[$i][2][4][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                        </div>
                        <div class="combat-bot-effects">
                            <img class="combat-effect" src="icons/default.png" alt="icons/default.png">
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="combat-interface-bot">
            <!-- TEAM2 -->
            <?php
            for ($i = 0; $i < count($team2); $i++) {
                ?>
                <div class="combat-wrap-bot">
                    <div class="combat-top">
                        <img class="combat-player-image" src="<?= $team2[$i][0][4] ?? "icons/default.png"; ?>"
                             alt="<?= $team2[$i][0][5] ?? "icons/default.png"; ?>">
                        <div class="combat-player-name"><?= $team2[$i][0][1] ?? "Player"; ?></div>
                        <div class="combat-healtbar">
                            <div id="combat-bar" class="combat-bar"></div>
                        </div>
                    </div>
                    <div class="combat-bot">
                        <div class="combat-bot-upper-actions">
                            <img class="combat-player-action" src="icons/broadsword.png" alt="icons/broadsword.png">
                            <img class="combat-player-action" src="<?= $team2[$i][2][0][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="icons/viking-shield.png" alt="icons/viking-shield.png">
                        </div>
                        <div class="combat-bot-spells">
                            <img class="combat-player-action" src="<?= $team2[$i][2][1][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team2[$i][2][2][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team2[$i][2][3][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                            <img class="combat-player-action" src="<?= $team2[$i][2][4][2] ?? "icons/default.png"; ?>"
                                 alt="icons/default.png">
                        </div>
                        <div class="combat-bot-effects">
                            <img class="combat-effect" src="icons/default.png" alt="icons/default.png">
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="combat-log">
        <?php
        //configurace souboje
        if($finished === 0){
            //echo "combat is not finished yet.";
        }
        else{
            //echo "combat is finished";
        }

        //tohle asi nemůže být v php - proměnné dát do db
        //zatim jen na 1v1
        //budou 3 fáze. Začátek(0) - působí efekty; Tah(1) - hráč se rozhodne jak bude táhnout; Konec tahu(2) - vše se vypočítá a vyhodnotí, hraje protější strana;

        if($playingteam === 0){
            if($hracvporadi === 0){
                if($faze === 0){
                    echo "Faze ".$faze."<br>";
                    echo "Hráč ".$team1[$hracvporadi][0][1]." je na řadě.<br>";
                    //ZacatekKola(); -- zpřístupni tlačítka na konkrétním hráči a rozsviť ho.
                    ?><script>kteryHracHraje(<?=$hracvporadi;?>);</script><?php
                    $faze++;
                }else if($faze === 1){
                    echo "Faze ".$faze."<br>";
                    //HracTahne();
                    $faze++;
                }else if($faze === 2){
                    echo "Faze ".$faze."<br>";
                    //KonecKola();
                    $faze=0;
                    $hracvporadi = 1;
                }
            }
        }

        if($playingteam === 1){
            if($hracvporadi === 0){
                if($faze === 0){
                    echo "Hráč ".$team2[$hracvporadi][0][1]." je na řadě.";
                    ?><script>kteryHracHraje(<?=$hracvporadi;?>);</script><?php
                    //ZacatekKola();
                    $faze++;
                }else if($faze === 1){
                    //HracTahne();
                    $faze++;
                }else if($faze === 2){
                    //KonecKola();
                    $faze=0;
                    $hracvporadi = 0;
                }
            }
        }
        //print_r($team1[0][0][1]);

        ?>
    </div>
    <?php
    /*
    <div class="combat-wrap">
        <div class="combat-top">
            <img class="combat-player-image" src="icons/cowled.png" alt="icons/cowled.png">
            <div class="combat-player-name">Jan</div>
            <div class="combat-healtbar"><div id="combat-bar" class="combat-bar"></div></div>
        </div>
        <div class="combat-bot">
            <div class="combat-bot-upper-actions">
                <img class="combat-player-action" src="icons/broadsword.png" alt="icons/broadsword.png">
                <img class="combat-player-action" src="icons/default.png" alt="icons/default.png">
                <img class="combat-player-action" src="icons/viking-shield.png" alt="icons/viking-shield.png">
            </div>
            <div class="combat-bot-spells">
                <img class="combat-player-action" src="icons/default.png" alt="icons/default.png">
                <img class="combat-player-action" src="icons/default.png" alt="icons/default.png">
                <img class="combat-player-action" src="icons/default.png" alt="icons/default.png">
                <img class="combat-player-action" src="icons/default.png" alt="icons/default.png">
            </div>
            <div class="combat-bot-effects">
                <img class="combat-effect" src="icons/default.png" alt="icons/default.png">
            </div>
        </div>
    </div>
    <script>
        var bar = document.getElementById("combat-bar");
        //bar.style.width = Math.floor(Math.random() * 100)+"%";
        bar.style.width = <?=$podilhp;?> + "%";
        console.log(bar);
    </script>*/
    ?>






