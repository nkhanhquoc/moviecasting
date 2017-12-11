/**
 * Created by HoangL on 03-May-16.
 */

$(function () {
    $('#match_id').change(function () {
        if ($('#match_id').val() > 0) {
            $('#match-detail-live').fadeOut(200).fadeIn(300, function () {
                $("input[name='FbMatchLive[minute]']").val('');
                $("input[name='FbMatchLive[home_type]']").val(0);
                $("input[name='FbMatchLive[home_info]']").val('');
                $("input[name='FbMatchLive[away_type]']").val(0);
                $("input[name='FbMatchLive[away_info]']").val('');
            });
        }
    })
});