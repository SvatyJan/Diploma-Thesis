<main class="admin-main">
    <?php
    $monsters = mysqli_query($conn, "SELECT * FROM monsters 
    LEFT JOIN race ON race.id_race = monsters.Race_id_race
    LEFT JOIN image ON image.id_image = monsters.Image_id_image");

    $allraces = mysqli_query($conn,"SELECT * FROM race");

    ?>
    <div class="admin-item-wrap">
        <p class="admin-paragraph">Add new Monster</p>
        <form method="POST" action="scripts/adminaddnewmonster.php">
            <label>Monster Name: </label>
            <input type="text" name="monstername" placeholder="Monster Name" required">
            <br>
            <label>Monster Race: </label>
            <select name="racename">
                <?php
                foreach ($allraces as $allrace) {
                    $allracename = $allrace["racename"];
                    ?>
                    <option><?= $allracename; ?></option><?php
                }
                ?>
            </select>
            <input type="submit" value="Add">
        </form>
    </div>

    <table class="admin-table">
        <?php
        foreach ($monsters as $monster) {
            $monsterid = $monster["id_monster"];
            $monstername = $monster["monster_name"];
            $monsterimgsrc = "icons/".$monster["source"];
            $monsterimgalt = $monster["alt"];
            ?>
            <tr class="admin-tr">
                <th class="admin-th">
                    <?= $monsterid; ?>
                </th>
                <th class="admin-th">
                    <?= $monstername; ?>
                </th>
                <th>
                    <img class="admin-object-icon" src="<?= $monsterimgsrc; ?>" alt="<?= $monsterimgalt; ?>">
                </th>
                <th class="admin-th">
                    <a href="index.php?pages=admin&adminpage=admineditmonster&id=<?=$monsterid; ?>">Edit</a>
                </th>
                <th class="admin-th">
                    <a href="scripts/admindeletemonster.php?&id=<?=$monsterid; ?>">X</a>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
</main>