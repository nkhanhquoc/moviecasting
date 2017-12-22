function fakeCrbtPlayer() {
    $("#jquery_jplayer_1").jPlayer({
        ready: function () {
            $(this).jPlayer("setMedia", {
                mp3: '/js/player/fakeAutoPlay.mp3',
            }).jPlayer("play").jPlayer("stop"); // auto play
        },
        ended: function (event) {
            //$(this).jPlayer("play");
            $(this).jPlayer("pause");
            $('.play-rbt-now').each(function () {
                $(this).children().children().removeClass('icon-pause-circle');
                $(this).children().children().removeClass('color-red');
                $(this).children().children().addClass('icon-play-circle');
                $(this).attr('check-play', '1');
            });
            //$('#playerCurrentBtnPlay').click();
        },
        play: function (event) {
            $(this).jPlayer("pauseOthers");
        }
    });
    //$("#jquery_jplayer_1").jPlayer('pauseOthers');
}

/**
 * huync2: fix docker player de bai nhac cuoi cung: 309412
 */
function marginDockerPlayer() {
    $('.item-imuzik-last').css('margin-bottom', ' 0px');
    $('.item-imuzik-last').last().css('margin-bottom', ' 50px');
}

$(document).ready(function () {
    $('#playerCurrentBtnPlay').click(function(){
        $("#jquery_jplayer_1").jPlayer('pause');
        $('.play-rbt-now').each(function () {
            $(this).attr('check-play', '1');
            $(this).children().children().removeClass('icon-pause-circle');
            $(this).children().children().removeClass('color-red');
            $(this).children().children().addClass('icon-play-circle');
        });

    });

    $('body').on("click", '.play-rbt-now', function () {
        var dataPlay = $(this).attr('data-play');
        var checkPlay = $(this).attr('check-play');
        if (checkPlay == '1') {
            if (dataPlay) {
                stopPlayerAnimation();
                dataPlay = $.base64Decode(dataPlay);
                dataPlay = $.parseJSON(dataPlay);
                $("#jquery_jplayer_1").jPlayer('pause');
                $('#jquery_jplayer_1 audio').attr('src', dataPlay.quality_path);
                $("#jquery_jplayer_1").jPlayer('play');
                $("#jquery_jplayer_1").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            mp3: dataPlay.quality_path,
                        }).jPlayer("play"); // auto play
                    },
                    ended: function (event) {
                        //$(this).jPlayer("play");
                        $(this).jPlayer("pause");
                        $('.play-rbt-now').each(function () {
                            $(this).children().children().removeClass('icon-pause-circle');
                            $(this).children().children().removeClass('color-red');
                            $(this).children().children().addClass('icon-play-circle');
                            $(this).attr('check-play', '1');
                        });
                        //$('#playerCurrentBtnPlay').click();
                    },
                    //swfPath: "swf",
                    //supplied: "mp3"
                }).bind($.jPlayer.event.play, function () { // pause other instances of player when current one play
                    $(this).jPlayer("pauseOthers");
                });

                $('.play-rbt-now').each(function () {
                    $(this).children().children().removeClass('icon-pause-circle');
                    $(this).children().children().removeClass('color-red');
                    $(this).children().children().addClass('icon-play-circle');
                    $(this).attr('check-play', '1');
                });
                $(this).attr('check-play', '2');
                $(this).children().children().addClass('icon-pause-circle');
                $(this).children().children().addClass('color-red');
                $(this).children().children().removeClass('icon-play-circle');
            }
        } else {
            $("#jquery_jplayer_1").jPlayer('pause');
            $('.play-rbt-now').each(function () {
                $(this).attr('check-play', '1');
                $(this).children().children().removeClass('icon-pause-circle');
                $(this).children().children().removeClass('color-red');
                $(this).children().children().addClass('icon-play-circle');
            });
            //$('#playerCurrentBtnPlay').click();
            $('#jp-play-rbt').click();
        }
    });

});