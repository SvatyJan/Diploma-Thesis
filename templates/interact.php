<main class="profile-interact-wrap">
<?php
//pokud jsi to ty, tak máš nastavení
//pokud je to někdo jiný, tak má nabídku na duel, friend, chat, trade
$hisid = $_GET["id"];

if($id != $hisid){
    ?>
    <div class="profile-interact">
    <figure>
        <img class="interact-icon"
             src="icons/default.png" alt="icons/default.png"/>
        <figcaption>Duel</figcaption>
    </figure>

    <figure>
        <a href="scripts/addfriend.php?id=<?= $hisid; ?>">
        <img class="interact-icon"
             src="icons/default.png" alt="icons/default.png"/>
        </a>
        <figcaption>Add Friend</figcaption>
    </figure>

    <figure>
        <img class="interact-icon"
             src="icons/default.png" alt="icons/default.png"/>
        <figcaption>Chat</figcaption>
    </figure>

    <figure>
        <img class="interact-icon"
             src="icons/default.png" alt="icons/default.png"/>
        <figcaption>Trade</figcaption>
    </figure>

        <figure>
            <img class="interact-icon"
                 src="icons/default.png" alt="icons/default.png"/>
            <figcaption>Invite</figcaption>
        </figure>
    </div>
    <?php
}
else{
    ?>
        <p class="interact-paragraph">Choose Icons</p>
    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=3">
        <img class="interact-icon" src="icons/cultist.png" alt="icons/cultist.png"/></a><figcaption>Cultist</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=4">
            <img class="interact-icon" src="icons/cowled.png" alt="icons/cowled.png"/></a><figcaption>Cowled</figcaption>
    </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=51">
            <img class="interact-icon" src="icons/woman-elf-face.png" alt="icons/woman-elf-face.png"/></a><figcaption>Elf Woman</figcaption>
    </figure>
        <figure>
            <a href="scripts/changeicon.php?iconid=6">
                <img class="interact-icon" src="icons/kenku-head.png" alt="icons/kenku-head.png"/></a><figcaption>Kenku</figcaption>
        </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=52">
            <img class="interact-icon" src="icons/dwarf-face.png" alt="icons/dwarf-face.png"/></a><figcaption>Dwarf</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=53">
            <img class="interact-icon" src="icons/bad-gnome.png" alt="icons/bad-gnome.png"/></a><figcaption>Gnome</figcaption>
    </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=45">
            <img class="interact-icon" src="icons/mermaid.png" alt="icons/mermaid.png"/></a><figcaption>Mermaid</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=44">
            <img class="interact-icon" src="icons/fish-monster.png" alt="icons/fish-monste.png"/></a><figcaption>Fish Monster</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=47">
            <img class="interact-icon" src="icons/triton-head.png" alt="icons/triton-head.png"/></a><figcaption>Triton</figcaption>
    </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=46">
            <img class="interact-icon" src="icons/orc-head.png" alt="icons/orc-head.png"/></a><figcaption>Orc</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=5">
            <img class="interact-icon" src="icons/minotaur.png" alt="icons/minotaur.png"/></a><figcaption>Minotaur</figcaption>
    </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=48">
            <img class="interact-icon" src="icons/shambling-zombie.png" alt="icons/shambling-zombie.png"/></a><figcaption>Zombie</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=54">
            <img class="interact-icon" src="icons/raise-zombie.png" alt="icons/raise-zombie.png"/></a><figcaption>Zombie Hand</figcaption>
    </figure>
    </div>

    <div class="profile-interact">
    <figure>
        <a href="scripts/changeicon.php?iconid=49">
            <img class="interact-icon" src="icons/djinn.png" alt="icons/djinn.png"/></a><figcaption>Djinn</figcaption>
    </figure>
    <figure>
        <a href="scripts/changeicon.php?iconid=50">
            <img class="interact-icon" src="icons/ifrit.png" alt="icons/ifrit.png"/></a><figcaption>Ifrit</figcaption>
    </figure>
    </div>
    <?php
}

?>

</main>
