<?php
$thisid = $_GET["id"];

$monsters = Select("SELECT * FROM monsters 
    LEFT JOIN race ON race.id_race = monsters.Race_id_race
    LEFT JOIN image ON image.id_image = monsters.Image_id_image
    WHERE monsters.id_monster = ? LIMIT 1", $thisid, $conn);

$staty = Select("SELECT * FROM monsters_has_Stats 
LEFT JOIN Stats ON id_stats = monsters_has_Stats.Stats_id_stats
WHERE Monsters_id_monster = ?", $thisid, $conn);

$monsterhasspells = Select("SELECT * FROM monsters_has_spells
    LEFT JOIN spells ON spells.id_spells = monsters_has_spells.Spells_id_spells
    LEFT JOIN image ON spells.Image_id_image = image.id_image
    LEFT JOIN spellslots ON monsters_has_spells.Spellslots_id_spellslots = spellslots.id_spellslots
    WHERE Monsters_id_monster = ?", $thisid, $conn, "s");

$races = mysqli_query($conn, "SELECT * FROM race");

$images = mysqli_query($conn, "SELECT * FROM image");

$allspells = mysqli_query($conn, "SELECT * FROM spells");
$allspellslots = mysqli_query($conn, "SELECT * FROM `spellslots`");
$allStats = mysqli_query($conn, "Select * FROM stats");

foreach ($monsters as $monster) {
    $monsterid = $monster["id_monster"];
    $monstername = $monster["monster_name"];
    $monsterimgsrc = "icons/" . $monster["source"];
    $monsterimgalt = $monster["alt"];
    ?>
    <div class="admin-edit-character-general-wrap">
        <img class="admin-edit-character-icon" alt="<?= $monsterimgalt; ?>" src="<?= $monsterimgsrc; ?>">
        <div class="admin-edit-characters-name-wrap">
            <form method="POST" action="scripts/adminmonsterchangeicon.php">
                <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
                <select name="image">
                    <?php
                    foreach ($images as $image) {
                        $img = $image["source"];
                        if ($img === $monster["source"]) {
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
                    <form method="POST" action="scripts/adminmonsterchangename.php">
                        <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
                        <input class="admin-edit-characters-name" type="text" name="monstername"
                               value="<?= $monstername; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="character-profile-race">
                    <form method="POST" action="scripts/adminmonsterchangerace.php">
                        <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
                        <select name="race">
                            <?php
                            foreach ($races as $race) {
                                $rasa = $race["racename"];
                                if ($rasa === $monster["racename"]) {
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
        </table>
    </div>
    <hr>
    <p class="admin-edit-character-stats-title">Stats</p>
    <div class="admin-item-wrap">
        <?php
        if (empty($staty)) {
            echo "Monster has no stats.";
        } else {
            foreach ($staty as $stat) {
                $statid = $stat["id_stats"];
                $statname = $stat["statname"];
                $statvalue = $stat["value"];
                ?>
                <form method="POST" action="scripts/adminchangemonsterattribute.php">
                    <div class="admin-item-name"><?= $statname; ?>
                        <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
                        <input type="hidden" name="statid" value="<?= $statid; ?>">
                        <input type="number" step="any" name="statvalue" value="<?= $statvalue; ?>">
                        <input type="submit" value="Edit">
                        <a class="admin-general-delete"
                           href="scripts/adminmonsterstatdelete.php?monsterid=<?= $thisid; ?>&statid=<?= $statid; ?>">X</a>
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </div>
    <div class="admin-item-wrap">
        <p class="admin-edit-character-stats-title">Add Stat</p><br>
        <form method="POST" action="scripts/adminmonsteraddstat.php">
            <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
            <select name="statname">
                <?php
                foreach ($allStats as $allStat) {
                    $allstatname = $allStat["statname"];
                    ?>
                    <option><?= $allstatname; ?></option><?php
                }
                ?>
            </select>
            <input type="submit" value="Add">
        </form>
    </div>
    <?php
}
?>
<hr>
<p class="admin-edit-character-stats-title">Spells</p>
<div class="admin-general-main">
    <?php
    if (empty($monsterhasspells)) {
        echo "Monster has no spells.";
    } else {
        ?>
        <table class="admin-table">
            <?php
            foreach ($monsterhasspells as $monsterhasspell) {
                $spellid = $monsterhasspell["id_spells"];
                $spellname = $monsterhasspell["spellname"];
                $spellimgsrc = "icons/" . $monsterhasspell["source"];
                $spellimgalt = $monsterhasspell["alt"];
                $spellslotname = $monsterhasspell["spellslotname"];
                $spellslotid = $monsterhasspell["id_spellslots"];
                $vjakemjeslotu = $monsterhasspell["vJakemJeSlotu"];

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
                        <?= $spellslotname;?>
                    </th>
                    <th class="admin-th">
                        <form method="POST" action="scripts/adminmonstereditspell.php">
                            <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
                            <input type="hidden" name="spellid" value="<?= $spellid; ?>">
                            <input type="hidden" name="spellslotid" value="<?= $spellslotid; ?>">
                            <?php if($spellslotname === "passive" || $spellslotname === "ultimate"){?>
                                <input type="number" min="0" max="1" name="vjakemjeslotu" value="<?= $vjakemjeslotu; ?>">
                            <?php
                            }else{
                                ?>
                                <input type="number" min="0" max="3" name="vjakemjeslotu" value="<?= $vjakemjeslotu; ?>">
                            <?php
                            }
                            ?>
                            <input type="submit" value="Edit spell slot">
                        </form>
                    </th>
                    <th class="admin-th">
                        <a class="admin-general-delete"
                           href="scripts/adminmonsterdeletespell.php?spellid=<?= $spellid; ?>&monsterid=<?= $thisid; ?>">X</a>
                    </th>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>
    <form method="POST" action="scripts/adminmonsteraddspell.php">
        <input type="hidden" name="monsterid" value="<?= $thisid; ?>">
        <label>Spell </label>
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
</div>