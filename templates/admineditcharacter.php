<?php
$thisid = $_GET["id"];

$characters = Select("SELECT * FROM characters 
    LEFT JOIN race ON race.id_race = characters.Race_id_race
    LEFT JOIN rank ON rank.id_rank = characters.Rank_id_rank
    LEFT JOIN image ON image.id_image = characters.Image_id_image
    WHERE characters.id_character = ? LIMIT 1", $thisid, $conn);

$staty = Select("SELECT * FROM Characters_has_Stats 
LEFT JOIN Stats ON id_stats = Characters_has_Stats.Stats_id_stats
WHERE Characters_id_character = ?", $thisid, $conn);

$races = mysqli_query($conn, "SELECT * FROM race");

$images = mysqli_query($conn, "SELECT * FROM image");

$characterhasitems = Select("SELECT * FROM characters_has_items 
    LEFT JOIN items ON characters_has_items.Items_id_item = items.id_item
    LEFT JOIN image ON image.id_image = items.Image_id_image
WHERE Characters_id_character = ?", $thisid, $conn, "s");

$characterhasspells = Select("SELECT * FROM characters_has_spells 
    LEFT JOIN spells ON characters_has_spells.Spells_id_spells = spells.id_spells
    LEFT JOIN image ON image.id_image = spells.Image_id_image
    WHERE Characters_id_character = ?",$thisid,$conn,"s");

$allitems = mysqli_query($conn, "SELECT * FROM items");
$allspells = mysqli_query($conn, "SELECT * FROM spells");

foreach ($characters as $character) {
    $characterid = $character["id_character"];
    $charactername = $character["username"];
    $characterimage = "icons/" . $character["source"];
    $level = 0;
    $nextlevelxp = 0;
    $xp = 0;
    foreach ($staty as $stat) {
        if ($stat["statname"] === "level") {
            $level = $stat["value"];
            $nextlevelxp = $stat["value"] * 50;
        }
        if ($stat["statname"] === "xp") {
            $xp = $stat["value"];
        }
    }

    ?>
    <div class="admin-edit-character-general-wrap">
        <img class="admin-edit-character-icon" alt="<?= $characterimage; ?>" src="<?= $characterimage; ?>">
        <div class="admin-edit-characters-name-wrap">
            <form method="POST" action="scripts/admincharacterchangeicon.php">
                <input type="hidden" name="characterid" value="<?= $thisid; ?>">
                <select name="image">
                    <?php
                    foreach ($images as $image) {
                        $img = $image["source"];
                        if ($img === $character["source"]) {
                            ?>
                            <option selected=""><?= $img; ?></option><?php
                        } else {
                            ?>
                            <option><?= $img; ?></option><?php
                        }
                    }
                    ?></select>
                <input type="submit" value="Edit">
            </form>
        </div>
        <table class="admin-edit-general-table">
            <tr>
                <div class="admin-edit-characters-name-wrap">
                    <form method="POST" action="scripts/admincharacterchangename.php">
                        <input type="hidden" name="characterid" value="<?= $thisid; ?>">
                        <input class="admin-edit-characters-name" type="text" name="charactername"
                               value="<?= $charactername; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="character-profile-race">
                    <form method="POST" action="scripts/admincharacterchangerace.php">
                        <input type="hidden" name="characterid" value="<?= $thisid; ?>">
                        <select name="race">
                            <?php
                            foreach ($races as $race) {
                                $rasa = $race["racename"];
                                if ($rasa === $character["racename"]) {
                                    ?>
                                    <option selected=""><?= $rasa; ?></option><?php
                                } else {
                                    ?>
                                    <option><?= $rasa; ?></option><?php
                                }
                            }
                            ?></select>
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="character-profile-level"><?= "Level : " . $level; ?></div>
            </tr>
            <tr>
                <div class="character-profile-experience"><?= "Experience : " . $xp . " / $nextlevelxp"; ?></div>
            </tr>
        </table>
    </div>
    <hr>
    <p class="admin-edit-character-stats-title">Stats</p>
    <div class="admin-edit-character-stats-wrap">
        <table>
            <?php
            foreach ($staty as $stat) {
                ?>
                <form method="POST" action="scripts/admineditstat.php">
                    <input type="hidden" name="characterid" value="<?= $thisid; ?>">
                    <input type="hidden" name="statid" value="<?= $stat['id_stats']; ?>">
                    <tr>
                        <td><?= $stat['statname']; ?></td>
                        <td><input type="number" name="statvalue" value="<?= $stat['value']; ?>"></td>
                        <td><input type="submit" value="Edit"></td>
                    </tr>
                </form>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
}
?>
<hr>
<p class="admin-paragraph">Items</p>
<div class="admin-general-main">
    <p>Add Item</p>
    <form method="POST" action="scripts/admincharacteradditem.php">
        <input type="hidden" name="characterid" value="<?= $thisid;?>">
        <label>Item: </label>
        <select name="itemname">
            <?php
            foreach ($allitems as $allitem) {
                $allitemname = $allitem["itemname"];
                $allitemid = $allitem["id_item"];
                ?>
                <option><?= $allitemname; ?></option><?php
            }
            ?></select>
        <br>
        <label>Amount: </label>
        <input type="number" name="amount" value="1">
        <br>
        <input type="submit" value="Add item">
    </form>
</div>
<table class="admin-table">
    <?php
    foreach ($characterhasitems as $characterhasitem) {
        $itemid = $characterhasitem["id_item"];
        $itemname = $characterhasitem["itemname"];
        $itemimage = "icons/" . $characterhasitem["source"];
        $itemalt = $characterhasitem["alt"];
        $itemtimes = $characterhasitem["pocet"];


        ?>
        <tr class="admin-tr">
            <th class="admin-th">
                <?= $itemid; ?>
            </th>
            <th class="admin-th">
                <?= $itemname; ?>
            </th>
            <th class="admin-th">
                <img class="admin-object-icon" src="<?= $itemimage; ?>" alt="<?= $itemimage; ?>">
            </th>
            <th class="admin-th">
                <?=$itemtimes;?>
            </th>
            <th class="admin-th">
                <a class="admin-general-delete" href="scripts/admincharactersdeleteitem.php?itemid=<?=$itemid;?>&characterid=<?=$thisid;?>">X</a>
            </th>
        </tr>
        <?php
    }
    ?>
</table>
<hr>
<p class="admin-edit-character-stats-title">Spells</p>
<div class="admin-general-main">
    <p>Add Spell</p>
    <form method="POST" action="scripts/admincharacteraddspell.php">
        <input type="hidden" name="characterid" value="<?= $thisid;?>">
        <label>Spell: </label>
        <select name="spellname">
            <?php
            foreach ($allspells as $allspell) {
                $allspellname = $allspell["spellname"];
                $allspellid = $allspell["id_spell"];
                ?>
                <option><?= $allspellname; ?></option><?php
            }
            ?></select>
        <input type="submit" value="Add Spell">
    </form>
    <br>
</div>
<table class="admin-table">
    <?php
    foreach ($characterhasspells as $characterhasspell) {
        $spellid = $characterhasspell["id_spells"];
        $spellname = $characterhasspell["spellname"];
        $spellimgsrc = "icons/" . $characterhasspell["source"];
        $spellimgalt = $characterhasspell["alt"];

        ?>
        <tr class="admin-tr">
            <th class="admin-th">
                <?= $spellid; ?>
            </th>
            <th class="admin-th">
                <?= $spellname; ?>
            </th>
            <th class="admin-th">
                <img class="admin-object-icon" src="<?= $spellimgsrc; ?>" alt="<?= $spellimgalt; ?>">
            </th>
            <th class="admin-th">
                <a class="admin-general-delete" href="scripts/admincharactersdeletespell.php?spellid=<?=$spellid;?>&characterid=<?=$thisid;?>">X</a>
            </th>
        </tr>
        <?php
    }
    ?>
</table>