/**
 * Created by HUYNC2 on 7/6/2016.
 */
$(document).ready(function () {
    selectMatchBet();
    $('#fbbet-bet_type').change(function () {
        selectMatchBet();
    });
});

function selectMatchBet() {
    var type = $('#fbbet-bet_type').val();
    if (type.indexOf('[number]') > -1) {
        $('#field-fbbet-bet_number').show();
    } else {
        $('#field-fbbet-bet_number').hide();
    }
}