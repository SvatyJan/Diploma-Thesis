<?php
function DrawCharacterCard($conn, $characterId){

    /*$character = mysqli_query($conn,"SELECT * FROM characters
    LEFT JOIN image ON image.id_image = characters.Image_id_image
    LEFT JOIN race ON race.id_race = characters.Race_id_race
    WHERE id_character = $characterId LIMIT 1");*/

    $character = mysqli_query($conn,"SELECT * FROM characters 
    LEFT JOIN image ON image.id_image = characters.Image_id_image
    LEFT JOIN race ON race.id_race = characters.Race_id_race
    WHERE id_character = $characterId LIMIT 1");

    /* GENERAL */
    $characterimgsrc    = "icons/default.png";
    $characterimgalt    = "default.png";
    $charactername      = "Player";
    $maxhealth          = 100;
    $health             = 100;

    /* SPELLS */
    $passive        = "default.png";
    $firstspell     = "default.png";
    $secondspell    = "default.png";
    $thirdspell     = "default.png";
    $ultimatespell  = "default.png";

    foreach ($character as $newcharacter){
        $characterimgsrc    = "icons/".$newcharacter["source"];
        $characterimgalt    = $newcharacter["alt"];
        $charactername      = $newcharacter["username"];
    }

    $characterstats = Select("SELECT * FROM Characters_has_Stats
    LEFT JOIN Stats ON id_stats = Characters_has_Stats.Stats_id_stats
    WHERE Characters_id_character = ?", $characterId, $conn);

    foreach ($characterstats as $characterstat){
        if($characterstat["statname"] === "health"){
            $maxhealth = $characterstat["value"];
            $health = $characterstat["value"];
        }
    }
    $podilhp =  ($health/$maxhealth)*100;

    $characterhasitems = Select("SELECT * FROM characters_has_items 
    LEFT JOIN items ON characters_has_items.Items_id_item = items.id_item
    LEFT JOIN image ON image.id_image = items.Image_id_image
    WHERE Characters_id_character = ?", $characterId, $conn);

    /*print_r($character);
    print_r($characterstats);
    print_r($characterhasitems);*/
    ?>
    <div class="combat-wrap">
        <div class="combat-top">
            <img class="combat-player-image" src="<?=$characterimgsrc;?>" alt="<?=$characterimgalt;?>">
            <div class="combat-player-name"><?=$charactername;?></div>
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
        bar.style.width = <?=$podilhp;?> + "%";
    </script>
<?php
}
?>

