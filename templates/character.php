<?php
$playeritems = $player->getItems();

$helmet = "icons/head-slot.png";
$helmetid = NULL;
$body = "icons/chest-slot.png";
$bodyid = NULL;
$legs = "icons/legs-slot.png";
$legsid = NULL;
$feet = "icons/feet-slot.png";
$feetid = NULL;

$righthand = "icons/right-hand.png";
$righthandid = NULL;
$lefthand = "icons/left-hand.png";
$lefthandid = NULL;

$neck = "icons/neck-slot.png";
$neckid = NULL;
$belt = "icons/belt-slot.png";
$beltid = NULL;
$ring = "icons/ring-slot.png";
$ringid = NULL;
$trinket = "icons/trinket-slot.png";
$trinketid = NULL;

$playericon = "icons/" . $player->getIcon();

$playerxp = Select("SELECT * FROM `characters_has_stats` WHERE Stats_id_stats = 9 AND Characters_id_character = ?;", $id, $conn)[0];

foreach ($playeritems as $playeritem) {
    if ($playeritem->getSlotname() === "head") {
        $helmet = $playeritem->getItemicon();
        $helmetid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "chest") {
        $body = $playeritem->getItemicon();
        $bodyid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "legs") {
        $legs = $playeritem->getItemicon();
        $legsid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "feet") {
        $feet = $playeritem->getItemicon();
        $feetid = $playeritem->getId();
    }

    if ($playeritem->getSlotname() === "righthand") {
        $righthand = $playeritem->getItemicon();
        $righthandid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "lefthand") {
        $lefthand = $playeritem->getItemicon();
        $lefthandid = $playeritem->getId();
    }

    if ($playeritem->getSlotname() === "neck") {
        $neck = $playeritem->getItemicon();
        $neckid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "belt") {
        $belt = $playeritem->getItemicon();
        $beltid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "ring") {
        $ring = $playeritem->getItemicon();
        $ringid = $playeritem->getId();
    }
    if ($playeritem->getSlotname() === "trinket") {
        $trinket = $playeritem->getItemicon();
        $trinketid = $playeritem->getId();
    }
}
?>
<div class="character-wrap">
    <div class="character-container">
        <?php if ($helmetid === NULL) : ?>
            <div class="Helmet">
                <img src="<?= $helmet; ?>" alt="<?= $helmet; ?>">
            </div>
        <?php else : ?>
            <div class="Helmet">
                <a href='scripts/unequipitem.php?itemid=<?= $helmetid; ?>'><img src="<?= $helmet; ?>"alt="<?= $helmet; ?>"></a>
            </div>
        <?php endif; ?>

        <?php if ($bodyid === NULL) : ?>
            <div class="Body"><img src="<?= $body; ?>" alt="<?= $body; ?>"></div>
        <?php else : ?>
            <div class="Body">
                <a href='scripts/unequipitem.php?itemid=<?= $bodyid; ?>'><img src="<?= $body; ?>"alt="<?= $body; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($legsid === NULL) : ?>
            <div class="Legs"><img src="<?= $legs; ?>" alt="<?= $legs; ?>"></div>
        <?php else : ?>
            <div class="Legs">
                <a href='scripts/unequipitem.php?itemid=<?= $legsid; ?>'><img src="<?= $legs; ?>"alt="<?= $legs; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($feetid === NULL) : ?>
            <div class="Feet"><img src="<?= $feet; ?>" alt="<?= $feet; ?>"></div>
        <?php else : ?>
            <div class="Feet">
                <a href='scripts/unequipitem.php?itemid=<?= $feetid; ?>'><img src="<?= $feet; ?>"alt="<?= $feet; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($neckid === NULL) : ?>
            <div class="Neck"><img src="<?= $neck; ?>" alt="<?= $neck; ?>"></div>
        <?php else : ?>
            <div class="Neck">
                <a href='scripts/unequipitem.php?itemid=<?= $neckid; ?>'><img src="<?= $neck; ?>"alt="<?= $neck; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($beltid === NULL) : ?>
            <div class="Belt"><img src="<?= $belt; ?>" alt="<?= $belt; ?>"></div>
        <?php else : ?>
            <div class="Belt">
                <a href='scripts/unequipitem.php?itemid=<?= $beltid; ?>'><img src="<?= $belt; ?>"alt="<?= $belt; ?>"></a>
            </div>
        <?php endif; ?>

        <?php if ($ringid === NULL) : ?>
            <div class="Ring"><img src="<?= $ring; ?>" alt="<?= $ring; ?>"></div>
        <?php else : ?>
            <div class="Ring">
                <a href='scripts/unequipitem.php?itemid=<?= $ringid; ?>'><img src="<?= $ring; ?>"alt="<?= $ring; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($trinketid === NULL) : ?>
            <div class="Trinket"><img src="<?= $trinket; ?>" alt="<?= $trinket; ?>"></div>
        <?php else : ?>
            <div class="Trinket">
                <a href='scripts/unequipitem.php?itemid=<?= $trinketid; ?>'><img src="<?= $trinket; ?>"alt="<?= $trinket; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($righthandid === NULL) : ?>
            <div class="Right-Hand"><img src="<?= $righthand; ?>" alt="<?= $righthand; ?>"></div>
        <?php else : ?>
            <div class="Right-Hand">
                <a href='scripts/unequipitem.php?itemid=<?= $righthandid; ?>'><img src="<?= $righthand; ?>" alt="<?= $righthand; ?>"></a>
            </div>

        <?php endif; ?>

        <?php if ($lefthandid === NULL) : ?>
            <div class="Left-Hand"><img src="<?= $lefthand; ?>" alt="<?= $lefthand; ?>"></div>
        <?php else : ?>
            <div class="Left-Hand">
                <a href='scripts/unequipitem.php?itemid=<?= $lefthandid; ?>'><img src="<?= $lefthand; ?>" alt="<?= $lefthand; ?>"></a>
            </div>
        <?php endif; ?>
        <div class="Stats">
            <div class="Character-Name"><?= $player->getUsername(); ?></div>
            <div class="Level"><?= $player->getLevel(); ?></div>
            <div class="Xp"><?php
                if(($playerxp["value"] >= ($player->getLevel() * 50)) && $_GET["id"] === $_SESSION["id"]){
                    ?>
                    <a href="scripts/levelup.php?id=<?=$id?>" class="level-up">Level up!</a>
                <?php
                } else{
                echo ($playerxp["value"]."/".$player->getLevel() * 50);
                } ?>
                </div>
        </div>
        <div class="Icon"><img id="character-icon" src="<?= $playericon; ?>" alt="<?= $playericon; ?>"></div>
    </div>
    <div class="character-stats-wrap">
        <?= $player->getAllStats(); ?>
    </div>
</div>