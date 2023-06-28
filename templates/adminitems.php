<main class="admin-main">
    <?php
    $items = mysqli_query($conn, "SELECT * FROM items 
    LEFT JOIN itemslots ON itemslots.id_itemslots = items.ItemSlots_id_ItemSlots
    LEFT JOIN image ON image.id_image = items.Image_id_image");

    $images = mysqli_query($conn, "SELECT * FROM image");
    $itemslots = mysqli_query($conn, "SELECT * FROM itemslots");
    ?>
    <p class="admin-paragraph">Add item</p>
    <div class="admin-general-main">
        <form method="POST" action="scripts/admincreatenewitem.php">
            <label>Item Image: </label>
            <select name="image">
                <?php
                foreach ($images as $image) {
                    $img = $image["source"];
                    ?>
                    <option><?= $img; ?></option><?php
                }
                ?></select>
            <br>
            <label>Item Name: </label>
            <input type="text" name="itemname" value="" placeholder="Enter Item Name">
            <br>
            <input type="submit" value="Add Item">
        </form>
        <br>
        <p class="admin-paragraph">Item Slots</p>
        <table class="admin-table">

            <?php
            foreach ($itemslots as $itemslot) {
                $itemslotname = $itemslot["slotname"];
                $itemslotid = $itemslot["id_Itemslots"];
                ?>
                <tr class="admin-tr">
                    <th class="admin-th"><?= $itemslotname; ?></th>
                    <th class="admin-th"><a class="admin-general-delete"
                                            href="scripts/admindeleteitemslot.php?id=<?= $itemslotid; ?>">X</a></th>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <form method="POST" action="scripts/adminadditemslot.php">
            <label>Item Slot Name: </label>
            <input type="text" name="itemslotname" value="" placeholder="Enter Item slot Name">
            <br>
            <input type="submit" value="Add Item slot">
        </form>
    </div>
    <p class="admin-paragraph">Items</p>
    <table class="admin-table">
        <?php
        foreach ($items as $item) {
            $itemid = $item["id_item"];
            $itemname = $item["itemname"];
            $itemimage = "icons/" . $item["source"];

            ?>
            <tr class="admin-tr">
                <th class="admin-th">
                    <?= $itemid; ?>
                </th>
                <th class="admin-th">
                    <?= $itemname; ?>
                </th>
                <th class="admin-th">
                    <img class="admin-object-icon" src="<?= $itemimage; ?>" alt="<?= $itemimage; ?>">
                </th>
                <th class="admin-th">
                    <a href="index.php?pages=admin&adminpage=adminedititem&id=<?= $itemid; ?>">Edit</a>
                </th>
                <th class="admin-th">
                    <a class="admin-general-delete" href="scripts/admindeleteitem.php?id=<?= $itemid; ?>">X</a>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
</main>