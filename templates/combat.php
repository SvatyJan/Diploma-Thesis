<?php
require("classes/playerclass.php");
require("classes/monsterclass.php");
require("classes/itemclass.php");
require("classes/spellclass.php");

$getcombatid = Select("SELECT * FROM combat WHERE id_player = ?", $id, $conn)[0];
$combatid = $getcombatid["id_combat"];
$hracvporadi = $getcombatid["hracvporadi"];
$finihsed = $getcombatid["finished"];

$team1 = array();
$team2 = array();

//getni combat_has_characters currenthp kde character id = id hráče(session)
$getcombatcharacters = Select("SELECT * FROM combat_has_characters WHERE Combat_id_combat = ?", $combatid, $conn);
foreach ($getcombatcharacters as $getcombatcharacter) {
    $playerid = $getcombatcharacter["Characters_id_character"];
    $playercurrentHealth = $getcombatcharacter["currentHealth"];
    $playerteam = $getcombatcharacter["team"];

    $player = PlayerFactory::createPlayer($playerid);
    $player->setCurrentHealth($playercurrentHealth);
    if ($playerteam === 0) {
        array_push($team1, $player);
    }
    if ($playerteam === 1) {
        array_push($team2, $player);
    }
}

$getcombatmonsters = Select("SELECT * FROM combat_has_monsters WHERE Combat_id_combat = ?", $combatid, $conn);
foreach ($getcombatmonsters as $getcombatmonster) {
    $monsterid = $getcombatmonster["Monsters_id_monster"];
    $monstercurrentHealth = $getcombatmonster["currentHealth"];
    $monsterteam = $getcombatmonster["team"];

    $monster = MonsterFactory::createMonster($monsterid);
    $monster->setCurrentHealth($monstercurrentHealth);
    if ($monsterteam === 0) {
        array_push($team1, $monster);
    }
    if ($monsterteam === 1) {
        array_push($team2, $monster);
    }
}

$player = $team1[0];
$monster = $team2[0];

$playingorder = array();
for ($i = 0; $i < count($team1); $i++) {
    array_push($playingorder, $team1[$i]);
}
for ($i = 0; $i < count($team2); $i++) {
    array_push($playingorder, $team2[$i]);
}

$whoisplaying = "";

for ($i = 0; $i < count($playingorder); $i++) {
    if ($hracvporadi >= count($playingorder)) {
        $hracvporadi = 0;
    }
    if ($hracvporadi === $i) {
        $whoisplaying = $playingorder[$i]->getUsernameWithoutBlankSpaces();
    }
}

if ($hracvporadi + 1 > count($playingorder)) {
    $hracvporadi = 0;
}

//přidej funkci k třídám, aby uměli generovat classu "teamred" nebo "teamblue" k jejich <div class="combat-wrap-top">

//oprav útočení na spoluhráče
?>
<div class="game-field">
    <input type="hidden" id="playerid" value="<?= $id; ?>">
    <input type="hidden" id="playername" value="<?= $player->getUsername(); ?>">
    <input type="hidden" id="whoisplaying" value="<?= $whoisplaying; ?>">
    <input type="hidden" id="monsterid" value="<?= $monster->getId(); ?>">
    <input type="hidden" id="monstername" value="<?= $monster->getUsername(); ?>">
    <input type="hidden" id="hracvporadi" value="<?= $hracvporadi; ?>">
    <div class="combat-top-section">
        <a href="scripts/leavecombat.php" id="combat-close">X</a>

        <?php
        foreach ($team2 as $charcaterinteam2) {
            $charcaterinteam2->createCharacterCard($charcaterinteam2->getId());
        }
        ?>

    </div>

    <div class="combat-bot-section">
        <?php
        foreach ($team1 as $charcaterinteam1) {
            $charcaterinteam1->createCharacterCard($charcaterinteam1->getId());
        }
        ?>
    </div>
</div>

<div id="my-modal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <iv class="combat-modal-content">
        <div id="id" class="hidden">1</div>
        <div class="combat-modal-victory">
        </div>
        <a href="scripts/endcombat.php?id=<?= $id; ?>" class="combat-back">Back</a>
</div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("my-modal");

    function openModal() {
        document.getElementById("my-modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("my-modal").style.display = "none";
    }
</script>

