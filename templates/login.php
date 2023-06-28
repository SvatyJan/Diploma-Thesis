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
    <form class="login" action='scripts/login.php' method='POST'>
        <div class="display-flex-row">
            <label>Username</label>
            <input class="login-input" type='text' placeholder='Username' name='username' required>
        </div>
        <div class="display-flex-row">
            <label>Password</label>
            <input class="login-input" type='password' placeholder='Password' name='password' required>
        </div>
        <div class="display-flex-row">
            <input class="login-input submit" type='submit' value='Login'>
        </div>
    </form>
</main>
