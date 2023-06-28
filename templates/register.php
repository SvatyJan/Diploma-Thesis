<main class="main">
    <?php

    if (isset($_GET["success"])) {
        echo "Registrace proběhla v pořádku.";
    }

    $result = mysqli_query($conn, "SELECT * FROM Race");
    $races = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $racename = $row["racename"];
            $raceid = $row["id_race"];
            array_push($races, "<option value='$raceid'>$racename</option>");
        }
    }
    ?>
    <form class="login" action='scripts/createCharacter.php' method='POST'>
        <label class="login-label">Name</label>
        <input type='text' placeholder='Enter Character Name' name='charname' minlength='3' maxlength='20' required>
        <label class="login-label">Choose a race:</label>
        <select class="login-label" name='race'>
            <?php
            for($i = 0;$i <= 6;$i++){echo $races[$i];}
            ?>
        </select>
        <label class="login-label">Password</label>
        <input type='password' placeholder='Enter Password' name='password' minlength='3' required>
        <input type='password' placeholder='Enter Password Again' name='passwordagain' minlength='3' required>
        <input type='submit' value='Create Character'>
    </form>

</main>
