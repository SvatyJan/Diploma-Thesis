<?php
include("classes/playerclass.php");
include("classes/itemclass.php");
include("classes/spellclass.php");
$player = PlayerFactory::createPlayer($id);
$playeritems = $player->getAllItems();



?>

<main class="main-tavern">
<section class="tavern-playeritems">
    <?php
    foreach ($playeritems as $playeritem){
        ?>
        <a class="item-container" href='scripts/sellitem.php?itemid=<?=$playeritem->getId();?>&cost=<?=$playeritem->getValue();?>'>
            <div class="obal-obrazek-cena">
            <div class="item-count"><?=$playeritem->getPocet();?></div>
            <img class="item-icon" src="<?=$playeritem->getItemIcon();?>" alt="<?=$playeritem->getItemIcon();?>">
            </div>
            <div class="item-details">
                <h3 class="item-name"><?= $playeritem->getItemname();?></h3>
                <div class="item-value"><?=$playeritem->getValue();?></div>
            </div>
        </a>
    <?php
    }
    ?>
</section>
<section class="tavern-shopitems">
    <?php
    foreach ($items as $item) {
        ?>
        <a class="item-container" href='scripts/buyitem.php?itemid=<?= $item->getId();?>&cost=<?=$item->getValue();?>'>
            <div class="obal-obrazek-cena">
                <img class="item-icon" src="<?=$item->getItemIcon();?>" alt="<?=$item->getItemIcon();?>">
            </div>
            <div class="item-details">
                <h3 class="item-name"><?= $item->getItemname();?></h3>
                <div class="item-value"><?=$item->getValue();?></div>
            </div>
        </a>
    <?php
    }
    ?>
</section>
</main>