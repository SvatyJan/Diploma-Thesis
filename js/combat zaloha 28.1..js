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
    var action = undefined;
    var isAttacking = false;

    let whoissessionid = $("#whoissessionid").val();
    let whoisplaying = $("#whoisplaying").val();
    let whoisplayingid = $("input[id='playerid " + whoisplaying + "']").val();

    //console.log(whoisplaying); //Jan
    //console.log(whoissessionid); //1
    //console.log(whoisplayingid);  //1

    console.log(whoisplaying);

    highlightPlayer(whoisplaying);
    //podmínka že hráč může kliknout pouze na své action buttony
    $(".action").click(function () {
        if (whoissessionid === whoisplayingid) {
            if ($(this).is("#" + whoisplaying)) {
                //console.log("můžeš");
                action = $(this).attr("data-action");
                console.log(action);
                //když si vyberu utok/cekani/obrana, tak zavolam tu funkci
                if (action === actions.ATTACK) {
                    utoc();
                }

                if (action === actions.WAIT) {
                    cekej();
                }

                if (action === action.DEFEND) {
                    branSe();
                }


            } else {
                console.log("nemůžeš");
            }

        } else {
            console.log("Nejsi na tahu!");
            tahProtivnika(whoisplayingid, whoissessionid);
        }
    });


    function utoc() {
        $(".combat-wrap-top").click(function () {

            //když je připraven k útoku a zároveň nekliká na svůj combat-wrap-top
            if (isAttacking && $('.combat-wrap-top').not('#'+whoisplayingid)) {
                console.log("Utocim");
                isAttacking = false;
                hideHighlightPlayer(whoisplaying);
                attackHighlight(whoisplaying);

                let playerid = whoisplayingid;
                let targetid = $(this).attr('id').split(" ")[1];
                let targetname = $(this).attr('id').split(" ")[0];
                console.log(playerid,targetid,action);
                $(this).off("click");
                $(this).on("click");

                if (playerid && targetid && action && targetname) {
                let sendplayerjson = {"playerid": playerid, "targetid": targetid, "action": action, "targetname": targetname};
                console.log(sendplayerjson);
                $.ajax({
                    type: "POST",
                    url: "endpoints/combatendpoint.php",
                    data: {
                        json: JSON.stringify(sendplayerjson)
                    },
                    success: function (response) {
                        let odpoved = JSON.parse(response);
                        setTargetHP(odpoved.targetname,odpoved.targetcurrenthp, odpoved.targetmaxhp);
                        $(this).off("click");
                        $(this).on("click");
                        isAttacking = false;
                        koncimTah();
                    }
                })
                } else {
                    console.log("Některé z hodnot nejsou vyplněny nebo jsou neplatné.");
                }



            } else {
                isAttacking = true;
                console.log("Jsem pripraven k utoku");
                $(this).off("click");
                $(this).on("click");
                /*
                $('.teamblue .attack-button').removeClass('highlight');
                $('.teamblue .action').addClass('highlight');
                teamRedHighlighPlayersRemove();
                teamBlueHighlighAll();
                isAttacking = false;
                $(".teamred").off("click");
                $(".teamred").on("click");*/

            }
        });
    }

    function cekej() {
        //zredukuj všechny cooldowny hráče o 1
        koncimTah();
    }

    function branSe() {
        //pridej hraci classu, ktera bude signalizovat stit kolem nej.
    }

    function koncimTah() {
        console.log("koncim tah");
        whoisplaying.text(whoisplayingid);
    }

    function tahProtivnika(whoisplayingid, targetid){
        let sendjson = {"playerid": playerid, "targetid": targetid, "action": attack, "targetname": targetname};
        console.log(sendjson);
        $.ajax({
            type: "POST",
            url: "endpoints/combatendpoint.php",
            data: {
                json: JSON.stringify(sendjson)
            },
            success: function (response) {
                let odpoved = JSON.parse(response);
                setTargetHP(odpoved.targetname,odpoved.targetcurrenthp, odpoved.targetmaxhp);
                $(this).off("click");
                $(this).on("click");
                isAttacking = false;
                koncimTah();
            }
        })
    }

    function setTargetHP(targetname, currenthp, maxhp) {
        $("#playercurrenthp[data-targetname='" + targetname + "']").text(currenthp);
        $("#playerhealthbar[data-targetname='" + targetname + "']").css("width", currenthp / maxhp * 100 + "%");
        /*$("#monstercurrenthp").html(currenthp);
        $("#monsterhealthbar").css("width", currenthp / maxhp * 100 + "%");*/
    }

    function setPlayerHP(currenthp, maxhp) {
        $("#playercurrenthp").html(currenthp);
        $("#playerhealthbar").css("width", currenthp / maxhp * 100 + "%");
    }

    /* PLAY HIGHLIGHTS */
    function highlightPlayer(player) {
        $(".action[id='" + player + "']").addClass("highlight");
        $(".combat-wrap-top[id='" + player + "']").addClass("highlight");
    }

    function hideHighlightPlayer(player) {
        //$(".combat-wrap-top #"+player).addClass("highlight");
        $(".action[id='" + player + "']").removeClass("highlight");
        $(".combat-wrap-top[id='" + player + "']").removeClass("highlight");
    }

    function attackHighlight(player) {
        $(".attack-button[id='" + player + "']").addClass("highlight");
    }

    function attackHideHighlight(player) {
        $(".action[id='" + player + "'] .attack-button").removeClass("highlight");
    }

    /* BLUE TEAM HIGHLIGHTS */
    function teamBlueHighlighAll() {
        $(".teamblue .action").addClass("highlight");
        $(".teamblue").addClass("highlight");
    }

    function teamBlueHighlighAllRemove() {
        $(".teamblue .action").removeClass("highlight");
        $(".teamblue").removeClass("highlight");
    }

    function teamBlueHighlighActions() {
        $(".teamblue .action").addClass("highlight");
    }

    function teamBlueHighlighActionsRemove() {
        $(".teamblue .action").removeClass("highlight");
    }

    function teamBlueHighlighPlayers() {
        $(".teamblue").addClass("highlight");
    }

    function teamBlueHighlighPlayersRemove() {
        $(".teamblue").removeClass("highlight");
    }

    function teamBlueHighlightAttackButton() {
        $(".teamblue .attack-button").addClass("highlight");
    }

    function teamBlueHighlightAttackButtonRemove() {
        $(".teamblue .attack-button").removeClass("highlight");
    }

    /* RED TEAM HIGHLIGHTS */

    function teamRedHighlighAll() {
        $(".teamred .action").addClass("highlight");
        $(".teamred").addClass("highlight");
    }

    function teamRedHighlighAllRemove() {
        $(".teamred .action").removeClass("highlight");
        $(".teamred").removeClass("highlight");
    }

    function teamRedHighlighActions() {
        $(".teamred .action").addClass("highlight");
    }

    function teamRedHighlighActionsRemove() {
        $(".teamred .action").removeClass("highlight");
    }

    function teamRedHighlighPlayers() {
        $(".teamred").addClass("highlight");
    }

    function teamRedHighlighPlayersRemove() {
        $(".teamred").removeClass("highlight");
    }
});