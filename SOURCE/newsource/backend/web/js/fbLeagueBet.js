/**
 * Created by HUYNC2 on 7/6/2016.
 */
var urlLeague = '/fb-league-bet/get-group-id-by-bet?league_id=[league_id]';
$(document).ready(function () {
    selectLeagueBet();
    $('#fbbet-bet_type').change(function () {
        selectLeagueBet();
    });
});

function selectLeagueBet() {
    var type = $('#fbbet-bet_type').val();
    if (type.indexOf('[group_id]') > -1) {
        $('#field-fbbet-bet_group').show();
    } else {
        $('#field-fbbet-bet_group').hide();
    }
}

