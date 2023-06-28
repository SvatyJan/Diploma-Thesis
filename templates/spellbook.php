<?php
$playerspells = $player->getAllSpells();

$passive = NULL;
$firstspell = NULL;
$secondspell = NULL;
$thirdspell = NULL;
$ultimatespell = NULL;

$passiveicon = NULL;
$passiveid= NULL;
$firstspellicon = NULL;
$firstspellid= NULL;
$secondspellicon = NULL;
$secondspellid= NULL;
$thirdspellicon = NULL;
$thirdspellid= NULL;
$ultimatespellicon = NULL;
$ultimatespellid= NULL;

foreach ($playerspells as $playerspell) {
    if ($playerspell->getSpellslot() === "passive" && $playerspell->getvJakemJeSlotu() == 1) {
        $passive = $playerspell;
        $passiveid = $playerspell->getId();
        $passiveicon = "icons/" . $passive->getIcon();
    }
    if ($playerspell->getSpellslot() === "combat" && $playerspell->getvJakemJeSlotu() == 1) {
        $firstspell = $playerspell;
        $firstspellid = $playerspell->getId();
        $firstspellicon = "icons/" . $firstspell->getIcon();
    }
    if ($playerspell->getSpellslot() === "combat" && $playerspell->getvJakemJeSlotu() == 2) {
        $secondspell = $playerspell;
        $secondspellid = $playerspell->getId();
        $secondspellicon = "icons/" . $secondspell->getIcon();
    }
    if ($playerspell->getSpellslot() === "combat" && $playerspell->getvJakemJeSlotu() == 3) {
        $thirdspell = $playerspell;
        $thirdspellid = $playerspell->getId();
        $thirdspellicon = "icons/" . $thirdspell->getIcon();
    }
    if ($playerspell->getSpellslot() === "ultimate" && $playerspell->getvJakemJeSlotu() == 1) {
        $ultimatespell = $playerspell;
        $ultimatespellid = $playerspell->getId();
        $ultimatespellicon = "icons/" . $ultimatespell->getIcon();
    }
}
?>

<div class="spellbook-container">
    <?php if ($passive === NULL) { ?>
        <div class="passive"><img class="disabled" src="icons/default.png" src="default"><span>Passive</span></div> <?php } else {
        ?>
        <div class="passive"><a href="scripts/unequipspell.php?idhrace=<?=$id;?>&idkouzla=<?=$passiveid;?>" ><img src="<?= $passiveicon; ?>" alt="<?= $passive->getDescription(); ?>">
            </a><span><?= $passive->getSpellname();?></span></div>
        <?php
    } ?>

    <?php if ($firstspell === NULL) { ?>
        <div class="firstspell"><img class="disabled" src="icons/default.png" src="default"></div> <?php } else {
        ?>
    <div class="firstspell"><a href="scripts/unequipspell.php?idhrace=<?=$id;?>&idkouzla=<?=$firstspellid;?>" ><img src="<?= $firstspellicon; ?>" alt="<?= $firstspell->getDescription(); ?>"></a>
        <span><?= $firstspell->getSpellname();?></span></div>
        <?php
    } ?>

    <?php if ($secondspell === NULL) { ?>
        <div class="secondspell"><img class="disabled" src="icons/default.png" src="default"></div> <?php } else {
        ?>
        <div class="secondspell"><a href="scripts/unequipspell.php?idhrace=<?=$id;?>&idkouzla=<?=$secondspellid;?>" ><img src="<?= $secondspellicon; ?>" alt="<?= $secondspell->getDescription(); ?>"></a>
            <span><?= $secondspell->getSpellname();?></span></div>
        <?php
    } ?>

    <?php if ($thirdspell === NULL) { ?>
        <div class="thirdspell"><img class="disabled" src="icons/default.png" src="default"></div> <?php } else {
        ?>
        <div class="thirdspell"><a href="scripts/unequipspell.php?idhrace=<?=$id;?>&idkouzla=<?=$thirdspellid;?>" ><img src="<?= $thirdspellicon; ?>" alt="<?= $thirdspell->getDescription(); ?>"></a>
            <span><?= $thirdspell->getSpellname();?></span></div>
        <?php
    } ?>

    <?php if ($ultimatespell === NULL) { ?>
        <div class="ultimate"><img class="disabled" src="icons/default.png" src="default"></div> <?php } else {
        ?>
        <div class="ultimate"><a href="scripts/unequipspell.php?idhrace=<?=$id;?>&idkouzla=<?=$ultimatespellid;?>" ><img src="<?= $ultimatespellicon; ?>" alt="<?= $ultimatespell->getDescription(); ?>"></a>
            <span><?= $ultimatespell->getSpellname();?></span></div>
        <?php
    } ?>

    <div class="spells-catalog">
        <?php
        foreach ($playerspells as $playerspell) {
            ?>
            <div class="spells-catalog-spell">
                <img onclick='openModal("<?=$playerspell->getId();?>","<?=$playerspell->getSpellname();?>","<?=$playerspell->getIcon();?>","<?=$playerspell->getDescription();?>","<?=$playerspell->getAllStats();?>"
                        ,"<?=$playerspell->getSpellslot(); ?>",<?=$id;?>)'
                     class="spellbook-open-modal" src="<?= "icons/" . $playerspell->getIcon(); ?>" alt="<?= $playerspell->getDescription(); ?>">
                <span><?= $playerspell->getSpellname();?></span>
            </div>

            <?php
        }
        ?>
    </div>
</div>

<div id="my-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="id" class="hidden">1</div>
        <div class="spellbook-modal-container">
            <div id="spellbook-description" class="spellbook-description spellbook-modal-item">Co to kouzlo dela?</div>
            <div id="spellbook-icon" class="spellbook-icon spellbook-modal-item"><img id="itemicon" src="icons/default.png" alt="default"><div id="spellname">Kouzlo</div></div>
            <div id="spellbook-action" class="spellbook-action spellbook-modal-item">
                <div class="modal-actions1"></div>
                <div class="modal-actions2"></div>
                <div class="modal-actions3"></div>
            </div>
            <div id="spellbook-stats" class="spellbook-stats spellbook-modal-item">Stats</div>
        </div>
    </div>
</div>


<script>
    // Get the modal
    var modal = document.getElementById("my-modal");

    let spellid = document.querySelector('#id');
    let spellname = document.querySelector('#spellname');
    let description = document.querySelector('#spellbook-description');
    let action = document.querySelector('#spellbook-action');
    let stats = document.querySelector('#spellbook-stats');
    var modalactions1 = document.querySelector('.modal-actions1');
    var modalactions2 = document.querySelector('.modal-actions2');
    var modalactions3 = document.querySelector('.modal-actions3');

    function openModal(newspellid, newspellname,newicon, newdescription, newstats, newspellslot, newidhrace) {
        spellid.innerHTML = newspellid;
        document.getElementById("itemicon").src = "icons/"+newicon;
        description.innerHTML = newdescription;
        spellname.innerHTML = newspellname;
        stats.innerHTML = newstats;
        idspellslots = 0;

        var sendspellid = newspellid;

        if(newspellslot === "passive"){
            idspellslots = 2;
            modalactions1.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace='+newidhrace+'&idkouzla='+sendspellid+'&idSpellslot='+idspellslots+'&poradi=1">' +
                '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Passive</figcaption></figure>' +
                '</a>';
            modalactions2.innerHTML = "";
            modalactions3.innerHTML = "";
        }

        if(newspellslot === "combat"){
            idspellslots = 3;
            modalactions1.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace='+newidhrace+'&idkouzla='+sendspellid+'&idSpellslot='+idspellslots+'&poradi=1">' +
                '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>First Spell</figcaption></figure>' + '</a>';
            modalactions2.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace='+newidhrace+'&idkouzla='+sendspellid+'&idSpellslot='+idspellslots+'&poradi=2">' +
                '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Second Spell</figcaption></figure>' + '</a>';
            modalactions3.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace='+newidhrace+'&idkouzla='+sendspellid+'&idSpellslot='+idspellslots+'&poradi=3">' +
                '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Third Spell</figcaption></figure>' + '</a>';
        }

        if(newspellslot === "ultimate"){
            idspellslots = 4;
            modalactions1.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace='+newidhrace+'&idkouzla='+sendspellid+'&idSpellslot='+idspellslots+'&poradi=1">' +
                '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Ultimate</figcaption></figure>' +
                '</a>';
            modalactions2.innerHTML = "";
            modalactions3.innerHTML = "";
        }


        document.getElementById("my-modal").style.display = "block";
    }
    function closeModal() {
        document.getElementById("my-modal").style.display = "none";
    }
</script>

