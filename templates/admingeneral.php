<main class="admin-general-main">
    <?php
    // obrázky, rasy, lokace, questy(unlocked), professe, guildy, spellsloty, itemsloty
    //add and remove img?

    //když je nejaky hrac rasa, tak se rasa neda smazat
    echo "<p>Races</p>";
    $races = mysqli_query($conn,"SELECT * FROM race");
    foreach ($races as $race){
        $idrace = $race["id_race"];
        $racename = $race["racename"];
        ?>
        <form class="admin-general-figure" method="POST" action="scripts/admingeneralraceedit.php">
                    <input type="text" name="idrace" value="<?= $idrace; ?>">
                    <input type="text" name="racename" value="<?= $racename; ?>">
                    <input type="submit" value="Edit">
                    <a class="admin-general-delete" href="scripts/admingeneralracedelete.php?raceid=<?= $idrace; ?>">X</a>
        </form>
        <br>
        <?php
    }
    ?>
    <p>Create New Race</p>
    <form class="admin-general-figure" method="POST" action="scripts/admingeneralraceadd.php">
        <input type="text" name="racename" placeholder="Enter new Race Name">
        <input type="submit" value="Create">
    </form>

    <p>Create New Image</p>
    <form class="admin-general-figure" method="POST" action="scripts/admingeneralimageadd.php" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Create">
    </form>
    <?php

    $img = mysqli_query($conn,"SELECT * FROM image");
            echo "<p>Images</p>";
            foreach ($img as $imgs){
                $idimg = $imgs["id_image"];
                $srcimg = $imgs["source"];
                $altimg = $imgs["alt"];
            ?>
            <form class="admin-general-figure" method="POST" action="scripts/admingeneraliconedit.php">
                <input type="hidden" name="idimage" value="<?= $idimg; ?>">
                <input type="hidden" name="oldfilename" value="<?= $srcimg; ?>">
                <figure class="admin-general-figure">
                    <img class="admin-general-icon"
                         src="<?= "icons/".$srcimg; ?>" alt="<?= "icons/".$altimg; ?>"/>
                    <figcaption>
                        <input type="text" name="newfilename" value="<?= $srcimg; ?>">
                        <input type="text" name="newfilealt" value="<?= $altimg; ?>">
                        <input type="submit" value="Edit">
                        <a class="admin-general-delete" href="scripts/admingeneralimagedelete.php?imgid=<?= $idimg; ?>">X</a>
                    </figcaption>
                </figure>
            </form>
            <?php
            }
    ?>

</main>
