<main class="admin-main">
    <?php

    $spells = mysqli_query($conn, "SELECT * FROM spells 
    LEFT JOIN spellslots ON spellslots.id_spellslots = spells.Spellslots_id_spellslots
    LEFT JOIN image ON image.id_image = spells.Image_id_image");

    $images = mysqli_query($conn, "SELECT * FROM image");
    $spellslots = mysqli_query($conn, "SELECT * FROM spellslots");

    ?>
    <p class="admin-paragraph">Add Spell</p>
    <div class="admin-general-main">
        <form method="POST" action="scripts/admincreatenewspell.php">
            <label>Spell Image: </label>
            <select name="image">
                <?php
                foreach ($images as $image) {
                    $img = $image["source"];
                    ?>
                    <option><?= $img; ?></option><?php
                }
                ?></select>
            <br>
            <label>Spellslot: </label>
            <select name="spellslot">
                <?php
                foreach ($spellslots as $spellslot) {
                    $slot = $spellslot["spellslotname"];
                    ?>
                    <option><?= $slot; ?></option><?php
                }
                ?></select>
            <br>
            <label>Item Name: </label>
            <input type="text" name="spellname" value="" placeholder="Enter Spell Name">
            <br>
            <input type="submit" value="Add Spell">
        </form>
        <p class="admin-paragraph">Spell slots</p>
        <table class="admin-table">

            <?php
            foreach ($spellslots as $spellslot) {
                $spellslotname = $spellslot["spellslotname"];
                $spellslotid = $spellslot["id_spellslots"];
                ?>
                <tr class="admin-tr">
                    <th class="admin-th"><?= $spellslotname; ?></th>
                    <th class="admin-th"><a class="admin-general-delete"
                                            href="scripts/admindeletespellslot.php?id=<?= $spellslotid; ?>">X</a></th>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <form method="POST" action="scripts/adminaddspellslot.php">
            <label>Spell slot Name: </label>
            <input type="text" name="spellslotname" value="" placeholder="Enter Spell slot Name">
            <br>
            <input type="submit" value="Add Spell slot">
        </form>
    </div>
    <p class="admin-paragraph">Spells</p>
    <table class="admin-table">
        <?php

        foreach ($spells as $spell) {
            $spellid = $spell["id_spells"];
            $spellname = $spell["spellname"];
            $spellimage = "icons/" . $spell["source"];

            ?>
            <tr class="admin-tr">
                <th>
                    <?= $spellid; ?>
                </th>
                <th class="admin-th">
                    <?= $spellname; ?>
                </th>
                <th class="admin-th">
                    <img class="admin-object-icon" src="<?= $spellimage; ?>" alt="<?= $spellimage; ?>">
                </th>
                <th class="admin-th">
                    <a href="index.php?pages=admin&adminpage=admineditspell&id=<?= $spellid; ?>">Edit</a>
                </th>
                <th class="admin-th">
                    <a class="admin-general-delete" href="scripts/admindeletespell.php?id=<?= $spellid; ?>">X</a>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    //select všech kouzel z databáze a jejich výpis.
    // pak jejich editace
    // tvorba

    ?>
</main>