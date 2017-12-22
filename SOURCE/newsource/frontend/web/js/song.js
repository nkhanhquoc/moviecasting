/**
 * Created by khanhnq16 on 13-Nov-15.
 */
function addToPlaylist(slug) {
    // var slug = $('#song-function-slug').val();
    var data_play = $('#song-' + slug).attr('data-play');
    data_play = $.base64Decode(data_play);
    data_play = $.parseJSON(data_play);
    if (isDockedPlayerHasData) {
        myPlaylist.add(data_play, false);
    } else {
        var playlistFake = [data_play];
        myPlayer.jPlayer("setMedia", {
            mp3: "/js/player/fakeAutoPlay.mp3"
        }).jPlayer("play").jPlayer("stop");
        myPlaylist.setPlaylist(playlistFake);
    }
    // switch (currentPagePjax) {
    //     case pjaxPageEnum.playlistPage:
    //     {
    //         $('#dockedPlayer').hide();
    //     }
    //         break;
    //     case pjaxPageEnum.topicPage:
    //     {
    //         $('#dockedPlayer').hide();
    //     }
    //         break;
    //     default :
    //     {
    //         $('#dockedPlayer').show();
    //     }
    // }

}


function downloadSong() {
    var slug = $('#song-slug').val();
    //var quality = myPlaylist.quality;
    // var quality = $('#ddlSongQuality').val();
    var quality ="128kbs";
//    $('.loading').show();
//    $.ajax({
//        type: "GET",
//        url: "/song/download/" + slug + "/" + quality,
//        container: '#ajaxBodyContent',
//        success: function (data) {
//            $('.loading').hide();
//            if (data == 1) {
//                $('#message-content').html("Lỗi hệ thống, xin quý khách vui lòng thử lại sau!");
//                $('#message-box').modal('show');
//            }
//        },
//        error: function (request, status, err) {
//            $('.loading').hide();
//        }
//    });
    window.location = "/song/download/" + slug + "/" + quality;

//    window.open("/song/download/" + slug+"/"+quality, '_blank', 'fullscreen=yes');
}
