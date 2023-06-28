<div class="character-wrap">
    <div class="character-prvnicast">
        <?php
        if ($headslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$headslot'><img class='character-item-box' src='$headsloticon' alt='Head Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$headsloticon' alt='Head Slot'>";
        }

        if ($chestslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$chestslot'><img class='character-item-box' src='$chestsloticon' alt='Chest Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$chestsloticon' alt='Chest Slot'>";
        }

        if ($legsslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$legsslot'><img class='character-item-box' src='$legssloticon' alt='Legs Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$legssloticon' alt='Legs Slot'>";
        }

        if ($feetslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$feetslot'><img class='character-item-box' src='$feetsloticon' alt='Feet Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$feetsloticon' alt='Feet Slot'>";
        }
        ?>
    </div>
    <div class="character-druhacast">
        <img class="character-profile-icon" src="<?= "icons/" . $hrac["source"]; ?>" alt="Profile Icon">
        <div class="character-profile-name"><?= $hrac["username"];?></div>
        <div class="character-profile-race"><?= $race["racename"];?></div>
        <div class="character-profile-level"><?= "Level : ".$level; ?></div>
        <div class="character-profile-experience"><?= "Experience : " . $xp . " / $nextlevelxp"; ?></div>
        <div class="character-druhacast-weapons">
            <?php
            if ($lefthandslot != NULL) {
                echo "<a href='scripts/unequipitem.php?itemid=$lefthandslot'><img class='character-item-box-weapons' src='$lefthandsloticon' alt='Left Hand'></a>";
            } else {
                echo "<img class='character-item-box-weapons' src='$lefthandsloticon' alt='Left Hand'>";
            }

            if ($righthandslot != NULL) {
                echo "<a href='scripts/unequipitem.php?itemid=$righthandslot'><img class='character-item-box-weapons' src='$righthandsloticon' alt='Right Hand'></a>";
            } else {
                echo "<img class='character-item-box-weapons' src='$righthandsloticon' alt='Right Hand'>";
            }
            ?>
        </div>
    </div>
    <div class="character-treticast">
        <?php
        if ($neckslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$neckslot'><img class='character-item-box' src='$necksloticon' alt='Neck Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$necksloticon' alt='Neck Slot'>";
        }

        if ($beltslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$beltslot'><img class='character-item-box' src='$beltsloticon' alt='Belt Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$beltsloticon' alt='Belt Slot'>";
        }

        if ($ringslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$ringslot'><img class='character-item-box' src='$ringsloticon' alt='Ring Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$ringsloticon' alt='Ring Slot'>";
        }

        if ($trinketslot != NULL) {
            echo "<a href='scripts/unequipitem.php?itemid=$trinketslot'><img class='character-item-box' src='$trinketsloticon' alt='Trinket Slot'></a>";
        } else {
            echo "<img class='character-item-box' src='$trinketsloticon' alt='Trinket Slot'>";
        }
        ?>
    </div>

</div>