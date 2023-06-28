const actions = {
    DEFAULT: "default",
    ATTACK: "attack",
    WAIT: "wait",
    DEFEND: "defend",
    SPELL1: "spell1",
    SPELL2: "spell2",
    SPELL3: "spell3",
    SPELL4: "spell4"
};

$(document).ready(function () {
    let playerid = $("#playerid").val();
    let playername = $("#playername").val();
    let monstername = $("#monstername").val();
    let monsterid = $("#monsterid").val();

    let whoisplaying = $("#whoisplaying").val();
    let whoisplayingid = $("input[id='playerid " + whoisplaying + "']").val();
    let hracvporadi = $("#hracvporadi").val();

    console.log("player id: " + playerid);
    console.log("player name: " + playername);
    console.log("monster id: " + monsterid);
    console.log("monster name: " + monstername);
    console.log("who is playing: " + whoisplaying);
    console.log("hrac v poradi: " + hracvporadi); //0-hrac 1-monstrum

    highlightPlayer(playername, playerid);
    highlightPlayerActions(playername);

    $(".action").click(function () {
        if (playerid === whoisplayingid) {
            if ($(this).is("#" + whoisplaying)) {
                action = $(this).attr("data-action");
                console.log(action);
                if (action === actions.ATTACK) {
                    HracUtok();
                }

                if (action === actions.WAIT) {
                    cekej();
                }

                if (action === actions.DEFEND) {
                    branSe();
                }
                if(action === actions.SPELL1){
                    HracCaruje(1);
                }
                if(action === actions.SPELL2){
                    HracCaruje(2);
                }
                if(action === actions.SPELL3){
                    HracCaruje(3);
                }

            } else {
                console.log("nemůžeš");
            }

        } else {
            console.log("Nejsi na tahu!");
        }
    });

    function HracUtok() {
        if (($("#playercurrenthp[data-targetname='" + playername + "']").text()) > 0) {
            let json = {"playerid": playerid, "targetid": monsterid, "action": action};
            console.log(json);
            $.ajax({
                type: "POST",
                url: "endpoints/hracutok.php",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (response) {
                    let odpoved = JSON.parse(response);
                    setTargetHP(monstername, odpoved.targetcurrenthp, odpoved.targetmaxhp);
                    MonsterUtok();
                    $(this).off("click");
                    $(this).on("click");
                }
            })
        } else{
            console.log("Hráč je mrtvý");
            Konec(monstername);
        }
    }

    function HracCaruje(spellposition){
        if (($("#playercurrenthp[data-targetname='" + playername + "']").text()) > 0) {
            let json = {"playerid": playerid, "targetid": monsterid, "action": action, "spellposition": spellposition};
            console.log(json);
            $.ajax({
                type: "POST",
                url: "endpoints/hracspell.php",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (response) {
                    let spellodpoved = JSON.parse(response);
                    console.log(spellodpoved);
                    setTargetHP(spellodpoved.playername, spellodpoved.playercurrenthp, spellodpoved.playermaxhp);
                    setTargetHP(spellodpoved.monstername, spellodpoved.monstercurrenthp, spellodpoved.monstermaxhp);
                    $(this).off("click");
                    $(this).on("click");
                    MonsterUtok();
                }
            })
        } else{
            console.log("Hráč je mrtvý");
            Konec(monstername);
        }
    }

    function MonsterUtok() {
        if (($("#playercurrenthp[data-targetname='" + monstername + "']").text()) > 0) {
            let json = {"monsterid": monsterid, "targetid": playerid, "action": action};
            console.log(json);
            $.ajax({
                type: "POST",
                url: "endpoints/monsterutok.php",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (response) {
                    let odpovedmonster = JSON.parse(response);
                    setTargetHP(playername, odpovedmonster.targetcurrenthp, odpovedmonster.targetmaxhp);
                    $(this).off("click");
                    $(this).on("click");
                }
            })
        }
        else{
            console.log("Monstrum je mrtvé");
            Konec(playername);
        }
    }

    function cekej(){
        MonsterUtok();
    }

    function branSe(){

    }

    function Konec(kdovyhral){
        let json = {"playerid": playerid, "kdovyhral": kdovyhral};
        $.ajax({
            type: "POST",
            url: "endpoints/endcombat.php",
            data: {
                json: JSON.stringify(json)
            },
            success: function (response) {
                let odpovedcombat = JSON.parse(response);
                if(odpovedcombat.combatstate >= 1){
                    $(".combat-modal-victory").text(kdovyhral +" is Victorious!");
                    openModal();
                }
            }
        })
    }

    function setTargetHP(targetname, currenthp, maxhp) {
        $("#playercurrenthp[data-targetname='" + targetname + "']").text(currenthp);
        $("#playerhealthbar[data-targetname='" + targetname + "']").css("width", currenthp / maxhp * 100 + "%");
    }

    function highlightPlayerActions(playername, playerid) {
        $(".action[id='" + playername + "']").addClass("highlight");
    }

    function hidehighlightPlayerActions(playername, playerid) {
        $(".action[id='" + playername + "']").removeClass("highlight");
    }

    function highlightPlayer(playername, playerid) {
        $(".combat-wrap-top[id='" + playername + " " + playerid + "']").addClass("highlight");
    }

    function hidehighlightPlayer(playername, playerid) {
        $(".combat-wrap-top[id='" + playername + " " + playerid + "']").removeClass("highlight");
    }

    /*MODAL*/
    var modal = document.getElementById("my-modal");
    function openModal() {
        document.getElementById("my-modal").style.display = "block";
    }
    function closeModal() {
        document.getElementById("my-modal").style.display = "none";
    }

});