<?php
if(!(isset($_SESSION["login"]))){
    header("Location: index.php?pages=main");
}

//nactu vsechno z prvniho hrace
//id,name,image,hp,str,agi,int,armor,mr,dmg
//$player1 = SelectAllPlayer($id1,$conn);
//print_r($player1);

?>
<main class="main">
    <div class="combat-wrap">
        <div class="combat-player-ui">

            <div class="combat-player-ui-top">
                <figure>
                    <img class="combat-player-icon" src="icons/default.png" alt="icons/default.png"/>
                    <figcaption>Player 1</figcaption>
                </figure>

                <div class="health-bar-wrap">
                    <div class="health-bar" data-total="1000" data-value="1000">
                        <div class="bar">
                            <div class="hit"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="combat-player-ui-mid">
                <div class="combat-player-ui-mid-left-actions">
                <img class="interact-icon-attack" src="icons/broadsword.png" alt="icons/broadsword.png"/>
                <img class="interact-icon-defend" src="icons/viking-shield.png" alt="icons/viking-shield.png"/>
                </div>
                <div class="combat-player-ui-mid-spells-actions">
                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>First Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Second Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Thrid Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Ultimate Spell</figcaption>
                    </figure>
                </div>
            </div>

            <div class="combat-player-ui-bot">
                <div class="combat-player-ui-bot-left-actions">
                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Passive</figcaption>
                    </figure>
                </div>
                <div class="combat-player-ui-bot-status-effects-wrap">
                    <img class="combat-player-spell-effect-icon" src="icons/default.png" alt="icons/default.png"/>
                </div>
            </div>
        </div>
    </div>
    <!-- Konec horního UI-->
    <div class="combat-text-wrap">
        <div class="combat-text">
            Player 2 Deals 50 damage to Player 1
        </div>
    </div>
    <!-- Konec prostředního UI-->

    <div class="combat-wrap">
        <div class="combat-player-ui">

            <div class="combat-player-ui-top">
                <figure>
                    <img class="combat-player-icon" src="icons/default.png" alt="icons/default.png"/>
                    <figcaption>Player 2</figcaption>
                </figure>

                <div class="health-bar" data-total="1000" data-value="1000">
                    <div class="bar">
                        <div class="hit"></div>
                    </div>
                </div>
            </div>

            <div class="combat-player-ui-mid">
                <div class="combat-player-ui-mid-left-actions">
                    <img class="interact-icon-attack" src="icons/broadsword.png" alt="icons/broadsword.png"/>
                    <img class="interact-icon-defend" src="icons/viking-shield.png" alt="icons/viking-shield.png"/>
                </div>
                <div class="combat-player-ui-mid-spells-actions">
                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>First Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Second Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Thrid Spell</figcaption>
                    </figure>

                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Ultimate Spell</figcaption>
                    </figure>
                </div>
            </div>

            <div class="combat-player-ui-bot">
                <div class="combat-player-ui-bot-left-actions">
                    <figure>
                        <img class="combat-player-spell-icon"
                             src="icons/default.png" alt="icons/default.png"/>
                        <figcaption>Passive</figcaption>
                    </figure>
                </div>
                <div class="combat-player-ui-bot-status-effects-wrap">
                    <img class="combat-player-spell-effect-icon" src="icons/default.png" alt="icons/default.png"/>
                </div>
            </div>
        </div>
    </div>
</main>