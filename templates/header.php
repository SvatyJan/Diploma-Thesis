<?php
$id = $_SESSION['id'] ?? false;
$playerrank = $_SESSION['rank'] ?? false;

//zjisti jestli hráč má combat, jeslti ano, tak ho přehoď na startcombat.php
//ZATIM POKUD HO JEN ZAČAL
//$isplayerincombat = Select("SELECT * FROM combat WHERE id_player = ?",$id,$conn);
$isplayerincombat = Select("SELECT * FROM Combat 
LEFT JOIN Combat_has_Characters ON Combat.id_combat = Combat_has_Characters.Combat_id_combat
WHERE Combat_has_Characters.Characters_id_character = ? AND finished = 0", $id, $conn);
if (count($isplayerincombat) > 0) {
    header("Location: scripts/startcombat.php");
}

?>
<header class='header'>
    <nav class="menu-wrap">
        <?php if ($username): ?>
            <a class="menu-content" href='index.php?pages=main'>Adventure</a>
            <a class="menu-content" href='index.php?pages=tavern'>Shop</a>
            <a class="menu-content" href='index.php?pages=halloffame'>Hall of Fame</a>
            <a class="menu-content" href='index.php?pages=profile&id=<?= $id ?>'>Profile</a>
            <a class="menu-content" href='index.php?pages=friends'>Friends</a>
            <?php if ($playerrank == 2): ?>
                <a class="menu-content" href='index.php?pages=admin'>Admin</a>
            <?php endif; ?>
            <a class="menu-content" href='scripts/logout.php'>Logout</a>
        <?php endif; ?>
        <?php if (!$username): ?>
            <a class="menu-content" href='index.php?pages=main'>Home</a>
            <a class="menu-content" href='index.php?pages=login'>Login</a>
            <a class="menu-content" href='index.php?pages=register'>Register</a>
        <?php endif; ?>
    </nav>
</header>