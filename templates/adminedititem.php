<?php
$thisid = $_GET["id"];

$item = Select("SELECT * FROM items 
LEFT JOIN image on items.Image_id_image = image.id_image
LEFT JOIN itemslots on itemslots.id_Itemslots = items.ItemSlots_id_ItemSlots
WHERE id_item = ?", $thisid, $conn)[0];

$images = mysqli_query($conn, "SELECT * FROM image");

$itemstats = Select("SELECT * FROM items_has_stats 
    LEFT JOIN stats ON items_has_stats.Stats_id_stats = stats.id_stats
    WHERE Items_id_item = ?", $thisid, $conn);

$allStats = mysqli_query($conn, "Select * FROM stats");

$itemname = $item["itemname"];
$isWeapon = $item["isWeapon"];
$isConsumable = $item["isConsumable"];
$isEquippable = $item["isEquippable"];
$imageId = $item["id_image"];
$image = $item["source"];
$imgsrc = "icons/$image";
$imgalt = $item["alt"];
$itemslot = $item["id_Itemslots"];
$slotname = $item["slotname"];
$itemvalue = $item["Value"];
$itemdescription = $item["Description"];
?>
<div class="admin-item-wrap">
    <p class="admin-paragraph"><?=$itemname;?></p>
    <form method="POST" action="scripts/adminchangeitemicon.php">
        <img class="admin-item-image" src="<?= $imgsrc; ?>" alt="<?= $imgalt; ?>">
        <input type="hidden" name="itemid" value="<?= $thisid; ?>">
        <br>Item Image:
        <select name="image">
            <?php
            foreach ($images as $image) {
                $img = $image["source"];
                if ($img === $item["source"]) {
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
    <form method="POST" action="scripts/adminchangeitemattribute.php?name">
        <div class="admin-item-name">Item Name:
            <input type="hidden" name="itemid" value="<?= $thisid; ?>">
            <input type="text" name="itemname" value="<?= $itemname; ?>">
            <input type="submit" value="Edit">
        </div>
    </form>

    <form method="POST" action="scripts/adminchangeitemattribute.php?value">
        <div class="admin-item-name">Item Value:
            <input type="hidden" name="itemid" value="<?= $thisid; ?>">
            <input type="number" name="itemvalue" value="<?= $itemvalue; ?>">
            <input type="submit" value="Edit">
        </div>
    </form>
</div>
<hr>
<div class="admin-item-wrap">
    <p class="admin-paragraph">Stats</p>
    <?php
    if (empty($itemstats)) {
        echo "Item has no stats.";
    } else {
        foreach ($itemstats as $itemstat) {
            $statid = $itemstat["id_stats"];
            $statname = $itemstat["statname"];
            $statvalue = $itemstat["value"];
            ?>
            <form method="POST" action="scripts/adminchangeitemattribute.php?stat">
                <div class="admin-item-name"><?= $statname; ?>
                    <input type="hidden" name="itemid" value="<?= $thisid; ?>">
                    <input type="hidden" name="statid" value="<?= $statid; ?>">
                    <input type="number" step="any" name="statvalue" value="<?= $statvalue; ?>">
                    <input type="submit" value="Edit">
                    <a class="admin-general-delete" href="scripts/adminitemdelete.php?itemid=<?=$thisid;?>&statid=<?=$statid;?>">X</a>
                </div>
            </form>
            <?php
        }
    }
    ?>
</div>
<hr>
<div class="admin-item-wrap">
    <p class="admin-paragraph">Add Stat</p><br>
    <form method="POST" action="scripts/adminitemaddstat.php">
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
</div>
<hr>
<div class="admin-item-wrap">
    <p>Others</p>
    <form method="POST" action="scripts/adminchangeitemattribute.php?type">
        <input type="hidden" name="itemid" value="<?= $thisid; ?>">
        <label>Is Item a Weapon? </label>
        <?php
        if($item["isWeapon"] === 1){
            ?><input type="checkbox" name="isWeapon" checked><?php
        }else{
            ?><input type="checkbox" name="isWeapon"><?php
        }
        ?>
        <br>
        <label>Is Item Consumalbe? </label>
        <?php
        if($item["isConsumable"] === 1){
            ?><input type="checkbox" name="isConsumalbe" checked><?php
        }else{
        ?><input type="checkbox" name="isConsumalbe"><?php
        }
        ?>
        <br>
        <label>Is Item Equippable? </label>
        <?php
        if($item["isEquippable"] === 1){
            ?><input type="checkbox" name="isEquippable" checked><?php
        }else{
            ?><input type="checkbox" name="isEquippable"><?php
        }
        ?>
        <br>
        <input type="submit" value="Edit">
    </form>
</div>
<div class="admin-item-wrap">
    <p>Description</p>
    <p><b><?=$itemdescription;?></b></p>
    <form method="POST" action="scripts/adminchangeitemdescription.php">
        <input type="hidden" name="itemid" value="<?= $thisid; ?>">
        <label>Description </label>
        <input type="text" name="description" placeholder="Type new Item Description">
        <input type="submit" value="Edit">
    </form>
</div>




