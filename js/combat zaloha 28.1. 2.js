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
    let sessionname = $("#sessionname").val();
    let whoisplaying = $("#whoisplaying").val();
    let whoisplayingid = $("input[id='playerid " + whoisplaying + "']").val();
    let monstername = $("#monstername").val();
    let monsterid = $("#monsterid").val();

    /*console.log("SESSION ID: "+whoissessionid);
    console.log("SESSION Name: "+sessionname);
    console.log("Who is playing: "+whoisplaying);
    console.log("who is playing id: "+whoisplayingid);*/
    highlightPlayer(whoisplaying);

    console.log(whoisplaying + " Hraje");

    $(".action").click(function () {
        if (whoissessionid === whoisplayingid) {
            if ($(this).is("#" + whoisplaying)) {
                action = $(this).attr("data-action");
                console.log(action);
                if (action === actions.ATTACK) {
                    HracUtoci();
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
        }
    });

    if(whoisplaying != sessionname){
        MonsterUtoci();
    }

    function HracUtoci(){
        $(".combat-wrap-top").click(function () {

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
                            hracKonciTah();
                            whoisplaying = targetname;
                            hideHighlightPlayer(monstername);
                            MonsterUtoci();
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
                highlightPlayer(monstername);
                hideHighlightPlayer(sessionname);
            }
        });
    }

    function MonsterUtoci(){
        let playerid = whoissessionid;
        action = actions.ATTACK;
        console.log("monstrum utoci");

        let sendmonsterjson = {"monsterid": whoisplayingid, "targetid": playerid, "action": action, "targetname": sessionname};
        console.log(sendmonsterjson);
        $.ajax({
            type: "POST",
            url: "endpoints/monsterendpoint.php",
            data: {
                json: JSON.stringify(sendmonsterjson)
            },
            success: function (response) {
                let monsterodpoved = JSON.parse(response);
                console.log(monsterodpoved);
                setTargetHP(monsterodpoved.targetname,monsterodpoved.targetcurrenthp, monsterodpoved.targetmaxhp);
                monstrumKonciTah();
                //highlightPlayingPlayer(sessionname);
            }
        })
    }

    function setTargetHP(targetname, currenthp, maxhp) {
        $("#playercurrenthp[data-targetname='" + targetname + "']").text(currenthp);
        $("#playerhealthbar[data-targetname='" + targetname + "']").css("width", currenthp / maxhp * 100 + "%");
    }

    function setPlayerHP(currenthp, maxhp) {
        $("#playercurrenthp").html(currenthp);
        $("#playerhealthbar").css("width", currenthp / maxhp * 100 + "%");
    }

    function highlightPlayer(player) {
        $(".action[id='" + player + "']").addClass("highlight");
        $(".combat-wrap-top #"+player).addClass("highlight");
        //$(".combat-wrap-top[id='" + player + "']").addClass("highlight");
    }
    function hideHighlightPlayer(player) {
        //$(".combat-wrap-top #"+player).addClass("highlight");
        $(".action[id='" + player + "']").removeClass("highlight");
        $(".combat-wrap-top #"+player).removeClass("highlight");
        //$(".combat-wrap-top[id='" + player + "']").removeClass("highlight");
    }
    function attackHighlight(player) {
        $(".attack-button[id='" + player + "']").addClass("highlight");
    }
    function attackHideHighlight(player) {
        $(".action[id='" + player + "'] .attack-button").removeClass("highlight");
    }

    function hracKonciTah() {
        $("#whoisplaying").val(monstername);
    }

    function monstrumKonciTah(){
        $("#whoisplaying").val(sessionname);
    }

    function highlightPlayingPlayer(jmenokdohraje){
        whoisplaying.test(kdohraje);
        highlightPlayer(kdohraje);
    }

});