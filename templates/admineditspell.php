<?php
$thisid = $_GET["id"];

$spell = Select("SELECT * FROM spells 
    LEFT JOIN image on image.id_image = spells.Image_id_image
    LEFT JOIN spellslots on spellslots.id_spellslots = spells.Spellslots_id_spellslots
    WHERE id_spells = ?",$thisid,$conn)[0];

$spellstats = Select("SELECT * FROM spells_has_stats 
    LEFT JOIN stats ON spells_has_stats.Stats_id_stats = stats.id_stats
    WHERE Spells_id_spells = ?", $thisid, $conn);

$images = mysqli_query($conn, "SELECT * FROM image");

$idpsell = $spell["id_spells"];
$spellname = $spell["spellname"];
$spellimgid = $spell["id_image"];
$spellimgsrc = "icons/".$spell["source"];
$spellimgalt = $spell["alt"];
$spellslotid = $spell["id_spellslots"];
$spellslotname = $spell["spellslotname"];
$spelldescription = $spell["Description"];

$allStats = mysqli_query($conn, "Select * FROM stats");

?>
<div class="admin-item-wrap">
    <p class="admin-paragraph"><?=$spellname;?></p>
    <form method="POST" action="scripts/adminchangespellicon.php">
        <img class="admin-item-image" src="<?= $spellimgsrc; ?>" alt="<?= $spellimgalt; ?>">
        <input type="hidden" name="spellid" value="<?= $thisid; ?>">
        <br>Item Image:
        <select name="image">
            <?php
            foreach ($images as $image) {
                $img = $image["source"];
                if ($img === $spell["source"]) {
                    ?>
                    <option selected=""><?= $img; ?></option><?php
                } else {
                    ?>
                    <option><?= $img; ?></option><?php
                }
            }
            ?></select>
        <input type="submit" value="Edit">
        <br>
        <br>
    </form>
    <form method="POST" action="scripts/adminchangespellattribute.php?name">
        <div class="admin-item-name">Item Name:
            <input type="hidden" name="spellid" value="<?= $thisid; ?>">
            <input type="text" name="spellname" value="<?= $spellname; ?>">
            <input type="submit" value="Edit">
        </div>
    </form>
    <p>Stats</p>
    <?php
    if (empty($spellstats)) {
        echo "Spell has no stats.";
    } else {
        foreach ($spellstats as $spellstat) {
            $statid = $spellstat["id_stats"];
            $statname = $spellstat["statname"];
            $statvalue = $spellstat["value"];
            ?>
            <form method="POST" action="scripts/adminchangespellattribute.php?stat">
                <div class="admin-item-name"><?= $statname; ?>
                    <input type="hidden" name="spellid" value="<?= $thisid; ?>">
                    <input type="hidden" name="statid" value="<?= $statid; ?>">
                    <input type="number" step="any" name="statvalue" value="<?= $statvalue; ?>">
                    <input type="submit" value="Edit">
                    <a class="admin-general-delete" href="scripts/adminspelldelete.php?spellid=<?=$thisid;?>&statid=<?=$statid;?>">X</a>
                </div>
            </form>
            <?php
        }
    }
    ?>
    <p>Add Stat</p><br>
    <form method="POST" action="scripts/adminspelladdstat.php">
        <input type="hidden" name="itemid" value="<?= $thisid; ?>">
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
    <p class="admin-paragraph">Description</p>
    <?= $spelldescription?>
    <form method="POST" action="scripts/adminchangespelldescription.php">
        <input type="hidden" name="spellid" value="<?= $thisid; ?>">
        <label>Description </label>
        <input type="text" name="description" placeholder="Type new Spell Description">
        <input type="submit" value="Edit">
    </form>
</div>
