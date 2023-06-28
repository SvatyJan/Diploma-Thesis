const actions = {
    DEFAULT: "default",
    ATTACK: "attack",
    DEFEND: "defend"
};

$(document).ready(function () {
    var action = undefined;
    var faze = 1;
    teamBlueHighligh();

    $(".action").click(function () {
        action = $(this).attr("data-action");
        console.log(action);

        if(action === actions.ATTACK){
            teamBlueHideHighlight();
            teamRedHighligh();
            faze = 2;
        }
        if(action === actions.DEFEND){

        }

        if (faze === 2 && action === actions.ATTACK) {
            let playerid = $("#playerid").val();
            let monsterid = $("#monsterid").val();

            let sendjson = {"player_id": playerid, "monster_id": monsterid, "action": action};
            $.ajax({
                type: "POST",
                url: "endpoints/combatendpoint.php",
                data: {
                    //json: ('{"player_id": ' + JSON.stringify(playerid) + ',"enemy_id": 5,"attack": "autoattack"}')
                    json: JSON.stringify(sendjson)
                },
                success: function (response) {
                    let odpoved = JSON.parse(response);
                    //console.log(odpoved.player_id);
                    setMonsterHP(odpoved.monstercurrenthp, odpoved.monstermaxhp);
                    setPlayerHP(odpoved.playercurrenthp, odpoved.playermaxhp);
                    teamBlueHideHighlight();
                    teamRedHideHighlight();
                }
            });
        }
    });

    function setMonsterHP(currenthp, maxhp) {
        $("#monstercurrenthp").html(currenthp);
        $("#monsterhealthbar").css("width", currenthp / maxhp * 100 + "%");
    }

    function setPlayerHP(currenthp, maxhp) {
        $("#playercurrenthp").html(currenthp);
        $("#playerhealthbar").css("width", currenthp / maxhp * 100 + "%");
    }

    function teamBlueHighligh() {
        $(".teamblue").addClass("highlight");
    }

    function teamRedHighligh() {
        $(".teamred").addClass("highlight");
    }

    function teamBlueHideHighlight() {
        $(".teamblue").removeClass("highlight");
    }

    function teamRedHideHighlight() {
        $(".teamred").removeClass("highlight");
    }
});