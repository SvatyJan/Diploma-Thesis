<?php
//PASSIVE
$equippedpassives = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
    LEFT JOIN image ON image.id_image = spells.Image_id_image
WHERE Characters_has_spells.Spellslots_id_spellslots = 2 AND Characters_has_spells.vJakemJeSlotu = 1 AND Characters_has_spells.Characters_id_character = ? LIMIT 1", $hisid, $conn);

if ($equippedpassives != null) {
    /* EQUIPPED PASSIVE EXISTS */
    foreach ($equippedpassives as $equippedpassive) {
        $spellname = $equippedpassive["spellname"];
        $spellID = $equippedpassive["Spells_id_spells"];
        $spellslotid = $equippedpassive["Spellslots_id_spellslots"];
        $poradi = $equippedpassive["vJakemJeSlotu"];
        $imgsrc = "icons/" . $equippedpassive["source"];
        $imgalt = "icons/" . $equippedpassive["alt"];
        ?>
        <a class="spellbook-spell-proklik"
           href='scripts/unequipspell.php?idhrace=<?= $hisid ?>&idkouzla=<?= $spellID ?>'>
            <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
                <figcaption><?= $spellname; ?></figcaption>
            </figure>
        </a>
        <?php
    }
} else {
    /* NO PASSIVE IS EQUIPPED */
    $imgsrc = "icons/default.png";
    $imgalt = "icons/default.png";
    ?>
    <a class="spellbook-spell-proklik">
        <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
            <figcaption>Passive</figcaption>
        </figure>
    </a>
    <?php
}
?>

<?php
//COMBAT FIRST SPELL
$equipFirstCombatSpells = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
    LEFT JOIN image ON image.id_image = spells.Image_id_image
WHERE Characters_has_spells.Spellslots_id_spellslots = 3 AND Characters_has_spells.vJakemJeSlotu = 1 AND Characters_has_spells.Characters_id_character = ? LIMIT 1", $hisid, $conn);

if ($equipFirstCombatSpells != null) {
    /* EQUIPPED FIRST COMBAT SPELL EXISTS */
    foreach ($equipFirstCombatSpells as $equipFirstCombatSpell) {
        $spellname = $equipFirstCombatSpell["spellname"];
        $spellID = $equipFirstCombatSpell["Spells_id_spells"];
        $spellslotid = $equipFirstCombatSpell["Spellslots_id_spellslots"];
        $poradi = $equipFirstCombatSpell["vJakemJeSlotu"];
        $imgsrc = "icons/" . $equipFirstCombatSpell["source"];
        $imgalt = "icons/" . $equipFirstCombatSpell["alt"];
        ?>
        <a class="spellbook-spell-proklik"
           href='scripts/unequipspell.php?idhrace=<?= $hisid ?>&idkouzla=<?= $spellID ?>'>
            <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
                <figcaption><?= $spellname; ?></figcaption>
            </figure>
        </a>
        <?php
    }
} else {
    /* NO FIRST COMBAT SPELL IS EQUIPPED */
    $imgsrc = "icons/default.png";
    $imgalt = "icons/default.png";
    ?>
    <a class="spellbook-spell-proklik">
        <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
            <figcaption>First Combat Spell</figcaption>
        </figure>
    </a>
    <?php
}

//COMBAT SECOND SPELL
$equipSecondCombatSpells = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
    LEFT JOIN image ON image.id_image = spells.Image_id_image
WHERE Characters_has_spells.Spellslots_id_spellslots = 3 AND Characters_has_spells.vJakemJeSlotu = 2 AND Characters_has_spells.Characters_id_character = ? LIMIT 1", $hisid, $conn);

if ($equipSecondCombatSpells != null) {
    /* EQUIPPED SECOND COMBAT SPELL EXISTS */
    foreach ($equipSecondCombatSpells as $equipSecondCombatSpell) {
        $spellname = $equipSecondCombatSpell["spellname"];
        $spellID = $equipSecondCombatSpell["Spells_id_spells"];
        $spellslotid = $equipSecondCombatSpell["Spellslots_id_spellslots"];
        $poradi = $equipSecondCombatSpell["vJakemJeSlotu"];
        $imgsrc = "icons/" . $equipSecondCombatSpell["source"];
        $imgalt = "icons/" . $equipSecondCombatSpell["alt"];
        ?>
        <a class="spellbook-spell-proklik"
           href='scripts/unequipspell.php?idhrace=<?= $hisid ?>&idkouzla=<?= $spellID ?>'>
            <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
                <figcaption><?= $spellname; ?></figcaption>
            </figure>
        </a>
        <?php
    }
} else {
    /* NO SECOND COMBAT SPELL IS EQUIPPED */
    $imgsrc = "icons/default.png";
    $imgalt = "icons/default.png";
    ?>
    <a class="spellbook-spell-proklik">
        <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
            <figcaption>Second Combat Spell</figcaption>
        </figure>
    </a>
    <?php
}

//COMBAT THIRD SPELL
$equipThirdCombatSpells = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
    LEFT JOIN image ON image.id_image = spells.Image_id_image
WHERE Characters_has_spells.Spellslots_id_spellslots = 3 AND Characters_has_spells.vJakemJeSlotu = 3 AND Characters_has_spells.Characters_id_character = ? LIMIT 1", $hisid, $conn);

if ($equipThirdCombatSpells != null) {
    /* EQUIPPED Third COMBAT SPELL EXISTS */
    foreach ($equipThirdCombatSpells as $equipThirdCombatSpell) {
        $spellname = $equipThirdCombatSpell["spellname"];
        $spellID = $equipThirdCombatSpell["Spells_id_spells"];
        $spellslotid = $equipThirdCombatSpell["Spellslots_id_spellslots"];
        $poradi = $equipThirdCombatSpell["vJakemJeSlotu"];
        $imgsrc = "icons/" . $equipThirdCombatSpell["source"];
        $imgalt = "icons/" . $equipThirdCombatSpell["alt"];
        ?>
        <a class="spellbook-spell-proklik"
           href='scripts/unequipspell.php?idhrace=<?= $hisid ?>&idkouzla=<?= $spellID ?>'>
            <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
                <figcaption><?= $spellname; ?></figcaption>
            </figure>
        </a>
        <?php
    }
} else {
    /* NO Third COMBAT SPELL IS EQUIPPED */
    $imgsrc = "icons/default.png";
    $imgalt = "icons/default.png";
    ?>
    <a class="spellbook-spell-proklik">
        <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
            <figcaption>Third Combat Spell</figcaption>
        </figure>
    </a>
    <?php
}

//ULTIMATE SPELL
$equipUltimateSpells = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
    LEFT JOIN image ON image.id_image = spells.Image_id_image
WHERE Characters_has_spells.Spellslots_id_spellslots = 4 AND Characters_has_spells.vJakemJeSlotu = 1 AND Characters_has_spells.Characters_id_character = ? LIMIT 1", $hisid, $conn);

if ($equipUltimateSpells != null) {
    /* EQUIPPED Ultimate SPELL EXISTS */
    foreach ($equipUltimateSpells as $equipUltimateSpell) {
        $spellname = $equipUltimateSpell["spellname"];
        $spellID = $equipUltimateSpell["Spells_id_spells"];
        $spellslotid = $equipUltimateSpell["Spellslots_id_spellslots"];
        $poradi = $equipUltimateSpell["vJakemJeSlotu"];
        $imgsrc = "icons/" . $equipUltimateSpell["source"];
        $imgalt = "icons/" . $equipUltimateSpell["alt"];
        ?>
        <a class="spellbook-spell-proklik"
           href='scripts/unequipspell.php?idhrace=<?= $hisid ?>&idkouzla=<?= $spellID ?>'>
            <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
                <figcaption><?= $spellname; ?></figcaption>
            </figure>
        </a>
        <?php
    }
} else {
    /* NO Ultimate SPELL IS EQUIPPED */
    $imgsrc = "icons/default.png";
    $imgalt = "icons/default.png";
    ?>
    <a class="spellbook-spell-proklik">
        <figure><img class="spellbook-spellslot" src="<?= $imgsrc ?>" alt="<?= $imgalt ?>"/>
            <figcaption>Ultimate Spell</figcaption>
        </figure>
    </a>
    <?php
}
/* VYPIS EQUIPNUTYCH KOUZEL */
?>