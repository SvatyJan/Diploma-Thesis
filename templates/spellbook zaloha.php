<!-- tady se budou vypisovat všechna kouzla hráčů.
Pro zatím sem nastrkám několik basic kouzel, které má každý. (bez databáze)

1. je lepší mít spellsloty nahoře a pod tím kouzla + vyhledávání podle tagů a kategorií
2. pouze katalog kouzel, když se na kouzlo klikne, tak se zobrazí modál s spellsloty?

první varianta asi lepší -->

<div class="spellbook-spellslots-wrap">
    <!-- MODAL -->
    <dialog class="modal">
        <div class="modal-top">
            <img class="modal-top-icon" id="modal-top-icon" src="icons/default.png" alt="icons/default.png">
            <div class="modal-top-right">
                <div class="spell-name">Spellname</div>
            </div>
        </div>
        <hr>
        <div class="modal-description">
            <p>Spell Description</p>
        </div>
        Kam kouzlo půjde?
        <div class="modal-actions">

        </div>
        <div onclick="CloseModal()" class="modal-close">
            <button>Back</button>
        </div>
    </dialog>
    <script>
        var modal = document.querySelector('.modal');
        var spellname = document.querySelector('.spell-name');
        var modalactions = document.querySelector('.modal-actions');
        var idspellslots;
        var spellid;

        function OpenModal(newspellname, newspellicon, newidspellslots,newspellid) {
            spellname.innerHTML = newspellname;
            document.getElementById("modal-top-icon").src = newspellicon;
            modal.showModal();
            idspellslots = newidspellslots;
            spellid = newspellid;

            if(idspellslots == 2){
                modalactions.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace=<?= $hisid; ?>&idkouzla='+spellid+'&idSpellslot='+idspellslots+'&poradi=1">' +
                    '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Passive</figcaption></figure>' +
                    '</a>';
            }else if(idspellslots == 3){
                modalactions.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace=<?= $hisid; ?>&idkouzla='+spellid+'&idSpellslot='+idspellslots+'&poradi=1"><figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>First Combat Spell</figcaption></figure></a>'+
                    '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace=<?= $hisid; ?>&idkouzla='+spellid+'&idSpellslot='+idspellslots+'&poradi=2"><figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Second Combat Spell</figcaption></figure></a>'+
                '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace=<?= $hisid; ?>&idkouzla='+spellid+'&idSpellslot='+idspellslots+'&poradi=3"><figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Third Combat Spell</figcaption></figure></a>';
            }else if(idspellslots == 3) {
                modalactions.innerHTML = modalactions.innerHTML = '<a class="spellbook-spell-proklik" href="scripts/equipSpell.php?idhrace=<?= $hisid; ?>&idkouzla='+spellid+'&idSpellslot='+idspellslots+'&poradi=1">' +
                    '<figure><img class="spellbook-spellslot" src="icons/default.png" alt="icons/default.png"/><figcaption>Ultimate Spell</figcaption></figure>' +
                    '</a>';
            }
        }

        function CloseModal() {
            modal.close();
        }
    </script>
    <!-- MODAL -->
    <?php
    include_once("scripts/vypisEquippedSpells.php");
    ?>
</div>
<hr>
<!-- VYPIS KOUZEL, KTERÉ HRÁČ MÁ -->
<div class="spellbook-spells-wrap">
    <?php
    $character_spells = SELECT("SELECT * FROM Characters_has_spells 
    LEFT JOIN spells ON Characters_has_spells.Spells_id_spells = Spells.id_spells 
LEFT JOIN image ON image.id_image = spells.Image_id_image
LEFT JOIN spellslots ON Characters_has_spells.Spellslots_id_spellslots = spellslots.id_spellslots
WHERE Characters_has_spells.Characters_id_character = ?", $hisid, $conn);

    foreach ($character_spells as $character_spell) {
        $idSpell = $character_spell["id_spells"];
        $idSpellslot = $character_spell["Spellslots_id_spellslots"];
        $spellslotname = $character_spell["spellslotname"];
        $vJakemJeSlotu = $character_spell["vJakemJeSlotu"];
        $spellname = $character_spell["spellname"];
        $imgsrc = "icons/" . $character_spell["source"];
        $imgalt = "icons/" . $character_spell["alt"];
        ?>
        <figure>
            <img class="spellbook-spell-icon" onclick='OpenModal("<?= $spellname ?>","<?= $imgsrc; ?>","<?= $idSpellslot; ?>","<?= $idSpell; ?>")'
                 src="<?= $imgsrc; ?>" alt="<?= $imgalt; ?>"/>
            <figcaption><?= $spellname; ?></figcaption>
        </figure>
        <?php
    }
    ?>
</div>