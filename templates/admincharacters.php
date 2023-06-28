<main class="admin-main">
    <?php
    $characters = mysqli_query($conn, "SELECT * FROM characters 
    LEFT JOIN race ON race.id_race = characters.Race_id_race
    LEFT JOIN rank ON rank.id_rank = characters.Rank_id_rank
    LEFT JOIN image ON image.id_image = characters.Image_id_image");
    ?>
    <table class="admin-table">
        <?php
        foreach ($characters as $character) {
            $characterid = $character["id_character"];
            $charactername = $character["username"];
            $characterimage = "icons/".$character["source"];
            ?>
            <tr class="admin-tr">
                <th class="admin-th">
                    <?= $characterid; ?>
                </th>
                <th class="admin-th">
                    <?= $charactername; ?>
                </th>
                <th>
                    <img class="admin-object-icon" src="<?= $characterimage; ?>" alt="<?= $characterimage; ?>">
                </th>
                <th class="admin-th">
                    <a href="index.php?pages=admin&adminpage=admineditcharacter&id=<?=$characterid; ?>">Edit</a>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
</main>