<main class="main hlavnistranka">

    <?php if($username){?>
        <p class="main-paragraph">Quests</p>
        <div class="main-action-wrap">
            <div class="main-action disabled">
                <a href="index.php?pages=combatpve"><img src="icons/ogre.png" alt="HunT"></a>
                <span class="fight-tooltip-text">Wanted: Ogre</span>
            </div>
        </div>

        <p class="main-paragraph">Actions</p>
    <div class="main-action-wrap">
        <div class="main-action">
            <a href="scripts/startcombat.php"><img src="icons/swordman.png" alt="HunT"></a>
            <span class="fight-tooltip-text">Hunting</span>
        </div>

        <div class="main-action disabled">
            <a href="index.php?pages=combat"><img src="icons/fishing-pole.png" alt="HunT"></a>
            <span class="fight-tooltip-text">Fishing</span>
        </div>

        <div class="main-action disabled">
            <a href="index.php?pages=combat"><img src="icons/mining.png" alt="HunT"></a>
            <span class="fight-tooltip-text">Mining</span>
        </div>

        <div class="main-action disabled">
            <a href="index.php?pages=combat"><img src="icons/fruiting.png" alt="HunT"></a>
            <span class="fight-tooltip-text">Herbalism</span>
        </div>

        <div class="main-action disabled">
            <a href="index.php?pages=combat"><img src="icons/viking-shield.png" alt="HunT"></a>
            <span class="fight-tooltip-text">Patrol</span>
        </div>
    </div>

    <?php } else {?>
            <div class="notloggedin">
        Not logged in? <a href="index.php?pages=login">Login!</a>
            </div>
    <?php } ?>
</main>
