/**
 * Created by HoangL on 10/19/2015.
 */
var myPlaylist = null;
var myPlayer = null;
var myPlaylistData = null;
// For player rotate
var repeatRotateDocked;
var repeatRotateDetail;
var auto_select_song;
var default_select_song;
var isPlaying = false;
var fixFlash_mp4, // Flag: The m4a and m4v Flash player gives some old currentTime values when changed.
    fixFlash_mp4_id, // Timeout ID used with fixFlash_mp4
    ignore_timeupdate; // Flag used with fixFlash_mp4
var isDockedPlayerHasData = false;
var playerCurrentSongNameMarquee = null;
var lastUrlPopup = null,
    songDetailData,
    isSongDetailPlaying,
    isFixAutoPlay,
    imageBlurSong,
    qualityPathSong,
    currentSongQuality,
    listQualityCurrent,
    songQualityCurrent,
    songDetailDataEncode,
    lowSongPath,
    playlistQuality = {
        '500kbs': 'Lossless',
        '320kbs': '320Kb',
        '256kbs': '256Kb',
        '128kbs': '128KB'
    };

function marqueeSong() {
    $('#playerCurrentSongInfo').css('width', $(window).width() - $('#playerCurrentControlBar').width() - 20);
    var playerCurrentSongName = $('#playerCurrentSongName');
    if (playerCurrentSongNameMarquee) {
        playerCurrentSongNameMarquee.marquee('destroy');
        playerCurrentSongNameMarquee = null;
    }
    if (playerCurrentSongName[0].scrollWidth > playerCurrentSongName.innerWidth()) {
        playerCurrentSongNameMarquee = playerCurrentSongName.marquee({
            duplicated: true
        });
    }
}

$(document).ready(function() {
    // For bind playlist
    var expandPlayerProcess = document.getElementById('expandPlayerProcess');
    myPlayer = $('#playerCurrentHidden');
    var cssSelector = {
        jPlayer: myPlayer,
        cssSelectorAncestor: "#magicPlayer"
    };
    var options = {
        playlistOptions: {
            autoPlay: true,
            loopOnPrevious: true,
            shuffleOnLoop: true,
            functionLoadedPlaylist: 'loadedPlaylist',
            listQuality: auto_select_song,
            defaultType: 'mp3',
            quality: default_select_song,
            lyricPanel: ".divSongLyric"
        },
        swfPath: "/js",
        supplied: "m4a, mp3",
        useStateClassSkin: true,
        autoBlur: true,
        loop: true,
        smoothPlayBar: true,
        ready: function(event) {
            // Determine if Flash is being used and the mp4 media type is supplied. BTW, Supplying both mp3 and mp4 is pointless.
            fixFlash_mp4 = event.jPlayer.flash.used && /m4a|m4v/.test(event.jPlayer.options.supplied);
            isFixAutoPlay = true;
        },
        ended: function() {
            stopPlayerAnimation();
        },
        //suspend: function () {
        //    stopPlayerAnimation();
        //},
        //abort: function () {
        //    stopPlayerAnimation();
        //},
        error: function() {
            stopPlayerAnimation();
        },
        play: function() {
            myPlayer.jPlayer("pauseOthers"); // pause all players except this one.
            var currentCSA = myPlaylist.getCssSelectorAncestor();
            //var currentCSA = '';
            $.each(myPlaylist.playlist, function(index, song) {
                if (index == myPlaylist.current) {
                    // Bind song info
                    $("#playerCurrentSongName").text(song.title);
                    $(currentCSA + " " + ".playerExpandSongName").text(song.title);
                    $("#playerCurrentSingerName").text(song.artist);
                    $(currentCSA + " " + ".playerExpandSingerName").text(song.artist);
                    $("#playerCurrentSingerImg").attr('src', song.poster);
                    $(currentCSA + " " + ".image-singer-player").attr('src', song.poster);
                    // bindImageBgBlur(currentCSA + " " + ".img-bg-blur-popup", song.poster_blur);
                    bindImageBgBlur(".banner-02", song.poster_blur);
                    //Change playlist icon
                    // $(currentCSA + " " + '.playlistPlayPause').removeClass('icon-play-circle').removeClass('icon-pause-circle').addClass('icon-play-circle');
                    // $(currentCSA + " " + '.playlistPlayPause:eq(' + index + ')').removeClass('icon-play-circle').addClass('icon-pause-circle');
                    //For marquee song name
                    // listQualityCurrent = song.quality_list;
                    // songQualityCurrent = myPlaylist.getCurrentQualitySong();
                    //show icon play
                    $('.mask').hide();
                    $('.mask:eq(' + index + ')').show();
                    //end set player song

                    // $('#ddlPlaylistQuality').html('');
                    // $.each(playlistQuality, function(k, v) {
                    //     if ($.inArray(k, listQualityCurrent) >= 0) {
                    //         if (songQualityCurrent == k) {
                    //             $('#ddlPlaylistQuality').append('<option selected value="' + k + '">' + v + '</option>');
                    //         } else {
                    //             $('#ddlPlaylistQuality').append('<option value="' + k + '">' + v + '</option>');
                    //         }
                    //     }
                    // });
                    // $('#ddlPlaylistQuality').selectpicker('refresh');
                    // $('#ddlPlaylistQuality').on('changed.bs.select', function(e) {
                    //     myPlaylist.setQuality($('#ddlPlaylistQuality').val());
                    // });

                    marqueeSong();
                    wireLogSong(song.slug);
                    //khanhnq16
                    $('#share-current-song').attr('onclick', 'functionShare(\'http://' + window.location.host + '/song-detail/' + song.slug + '\',\'' + song.title + '\')');
                    $('#popup-docker-player-slug').val(song.slug);
                    $('#download-current-song').attr('onclick', 'downloadSongPlaylist()');
                    $('#rbt-current-song').attr('onclick', 'getListSongRbt(\'' + song.title + '\')');
                    //end khanhnq16
                }
            });
        },
        playing: function() {
            var currentCSA = myPlaylist.getCssSelectorAncestor();
            //var currentCSA = '';
            if (!isPlaying) {
                $(currentCSA + " " + ".imgMusicTool").rotate({
                    angle: 0,
                    center: ["26px", "26px"],
                    animateTo: 28,
                    callback: function() {
                        var angle = 0;
                        clearInterval(repeatRotateDocked);
                        repeatRotateDocked = setInterval(function() {
                            angle += 10;
                            $(currentCSA + " " + ".sub-round-play").rotate(angle);
                        }, 30);
                        isPlaying = true;
                    }
                });
                if ($('#songDetailPopup').length > 0) {
                    $('#btnSongDetailPlay').hide();
                    $('#btnSongDetailPause').show();
                    startPlayerAnimationId('#songDetailPopup');
                }
            }
        },
        pause: function() {
            stopPlayerAnimation();
        },
        timeupdate: function(event) {
            if (!ignore_timeupdate) {
                // currentTime / duration
                progressValue = event.jPlayer.status.currentPercentAbsolute;
                //expandPlayerProcess.slider("value", event.jPlayer.status.currentPercentAbsolute);
                $('#expandPlayerProcess .noUi-origin').css('left', '' + progressValue + '%');
                if ($('#songDetailPopup').length > 0 && isSongDetailPlaying) {
                    //$('#songDetailProcess').slider("value", event.jPlayer.status.currentPercentAbsolute);
                    $('#songDetailProcess .noUi-origin').css('left', '' + progressValue + '%');
                    $('#txtCurrentTime').html(('' + Math.round(event.jPlayer.status.currentTime)).toHHMMSS());
                    $('#txtSongDuration').html(('' + Math.round(event.jPlayer.status.duration)).toHHMMSS());
                }
            }
        }
    };

    myPlaylist = new jPlayerPlaylist(cssSelector, [], options);
    myPlaylistData = myPlayer.data("jPlayer");
    // console.log("set ui slider");
    noUiSlider.create(expandPlayerProcess, {
        start: 0,
        step: 0.1,
        range: {
            'min': 0,
            'max': 100
        }
    });
    expandPlayerProcess.noUiSlider.on('update', function(values, handle) {
        var sp = myPlaylistData.status.seekPercent;
        if (sp > 0) {
            // Apply a fix to mp4 formats when the Flash is used.
            if (fixFlash_mp4) {
                ignore_timeupdate = true;
                clearTimeout(fixFlash_mp4_id);
                fixFlash_mp4_id = setTimeout(function() {
                    ignore_timeupdate = false;
                }, 1000);
            }
            // Move the play-head to the value and factor in the seek percent.
            myPlayer.jPlayer("playHead", values[handle] * (100 / sp));
        } else {
            // Create a timeout to reset this slider to zero.
            setTimeout(function() {
                $('#expandPlayerProcess .noUi-origin').css('left', '0%');
            }, 0);
        }
    });

    // Modified theme player process
    //expandPlayerProcess.css('cursor', 'pointer');
    //expandPlayerProcess.find("div:eq(0)").addClass('real-time');
    //expandPlayerProcess.find("span:eq(0)").addClass('point').addClass('hold-point');

    $('#playerCurrentSongInfo').click(function() {
        $('#body_content').removeClass('enable-scroll').addClass('disable-scroll');
        disableOverScroll($('#body_content'));
        $('#playerCurrentExpanded').show().removeClass('disable-scroll').addClass('enable-scroll');
        enableOverScroll($('#playerCurrentExpanded'));
        $('#dockedPlayer').hide();
    });

    $('body').on("click", '.play-song-now', function() {
        myPlayer.jPlayer("setMedia", {
            mp3: "/js/player/fakeAutoPlay.mp3"
        }).jPlayer("play").jPlayer("stop");
        var dataPlay = $(this).attr('data-play');
        if (dataPlay) {
            //stopPlayerAnimation();
            dataPlay = $.base64Decode(dataPlay);
            dataPlay = $.parseJSON(dataPlay);
            var playlistFake = [dataPlay];
            myPlaylist.option("autoPlay", true);
            myPlaylist.setPlaylist(playlistFake);
            wireLogSong(dataPlay.slug);
        }
    }).on("click", '.play-playlist-now', function() {
        myPlayer.jPlayer("setMedia", {
            mp3: "/js/player/fakeAutoPlay.mp3"
        }).jPlayer("play").jPlayer("stop").jPlayer("next");
        var dataPlay = $(this).attr('data-play');
        if (dataPlay) {
            dataPlay = $.base64Decode(dataPlay);
            dataPlay = $.parseJSON(dataPlay);
            if (dataPlay.link) {
                //set ds bai hat vao docked
                // $('#expandPlayerProcess').html($('#magicPlaylistPlayer').html());
                // console.log(myPlaylist);
                // myPlaylist.option("autoPlay", true);
                myPlaylist.loadPlaylistJson(dataPlay.link);
                myPlaylist.play(0);
                wireLogPlaylist(dataPlay.slug);
            }
        }
    }).on("click", '.play-topic-now', function() {
        myPlayer.jPlayer("setMedia", {
            mp3: "/js/player/fakeAutoPlay.mp3"
        }).jPlayer("play").jPlayer("stop");
        var dataPlay = $(this).attr('data-play');
        if (dataPlay) {
            dataPlay = $.base64Decode(dataPlay);
            dataPlay = $.parseJSON(dataPlay);
            if (dataPlay.link) {
                //stopPlayerAnimation();
                myPlaylist.option("autoPlay", true);
                myPlaylist.loadPlaylistJson(dataPlay.link);
            }
        }
    }).on("click",'.song-in-list',function(){
      // e.preventDefault();
      var index = $(this).parent().parent().index();
      if(myPlaylist.playlist.length < 1){
          myPlayer.jPlayer("setMedia", {
              mp3: "/js/player/fakeAutoPlay.mp3"
          }).jPlayer("play").jPlayer("stop");
          var dataPlay = $('#playlist-data-play').attr('data-play');
          if (dataPlay) {
              dataPlay = $.base64Decode(dataPlay);
              dataPlay = $.parseJSON(dataPlay);
              if (dataPlay.link) {
                  //set ds bai hat vao docked
                  // myPlaylist.option("autoPlay", true);
                  myPlaylist.loadPlaylistJson(dataPlay.link);
                  // wireLogPlaylist(dataPlay.slug);
              }
          }
      }
      if (myPlaylist.current !== index) {
        myPlaylist.play(index);
      } else {
        $(myPlaylist.cssSelector.jPlayer).jPlayer("play");
      }
      myPlaylist.blur(this);
    });
    initSongContent();
});

function initSongContent() {
    if ($('#songDetailPopup').length > 0 && !isNavigation) {
        $('#songDetailPopup').addClass('wrapper-scroll').css('top', 0).css('left', 0).css('bottom', 0);
        disableOverScroll($('#body_content'));
        // enableOverScroll($('#songDetailPopup'));
        setHeightScroll();
        $('#ddlSongQuality').selectpicker('refresh');
        var songDetailProcess = $('#songDetailProcess');
        if (isSongDetailPlaying) {
            songDetailProcess.noUiSlider.off('update');
            isSongDetailPlaying = false;
        }
        stopPlayerAnimationId('#songDetailPopup');
        // $('#divSongDetailProcess').hide();
        var currentCSA = "#songDetailPopup";
        bindImageBgBlur(currentCSA + " " + ".playerImageBlur", imageBlurSong);
        bindImageBgBlur(".img-bg-blur-popup", imageBlurSong);

        if (songDetailProcess.noUiSlider) {
            // throw new Error('Slider was already initialized.');
            songDetailProcess.noUiSlider.destroy();
        }
        songDetailProcess = document.getElementById('songDetailProcess');
        noUiSlider.create(songDetailProcess, {
            start: 0,
            step: 0.1,
            range: {
                'min': 0,
                'max': 100
            }
        });

        var songPlayerGetInfo = $('#songPlayerGetInfo');
        songPlayerGetInfo.jPlayer({
            swfPath: "/js",
            supplied: "m4a, mp3",
            useStateClassSkin: true,
            autoBlur: true,
            loop: true,
            smoothPlayBar: true,
            cssSelectorAncestor: "#divSongDetailProcess",
            ready: function(event) {
                $(this).jPlayer("setMedia", lowSongPath).jPlayer("play");
            },
            play: function(event) {
                $(this).jPlayer("stop");
            }
        });

        $('#btnSongDetailPlay').off('click').on('click', function() {
            if (isSongDetailPlaying == false) {
                myPlayer.jPlayer('stop');
                songDetailProcess.noUiSlider.on('update', function(values, handle) {
                    var sp = myPlaylistData.status.seekPercent;
                    if (sp > 0) {
                        // Apply a fix to mp4 formats when the Flash is used.
                        if (fixFlash_mp4) {
                            ignore_timeupdate = true;
                            clearTimeout(fixFlash_mp4_id);
                            fixFlash_mp4_id = setTimeout(function() {
                                ignore_timeupdate = false;
                            }, 1000);
                        }
                        // Move the play-head to the value and factor in the seek percent.
                        myPlayer.jPlayer("playHead", values[handle] * (100 / sp));
                    } else {
                        // Create a timeout to reset this slider to zero.
                        setTimeout(function() {
                            $('#songDetailProcess .noUi-origin').css('left', '0%');
                        }, 0);
                    }
                });
                isSongDetailPlaying = true;
                // Set data play
                // $('#divSongDetailProcess').slideDown(1000);
                songDetailDataEncode = $.base64Decode(songDetailDataEncode);
                songDetailDataEncode = $.parseJSON(songDetailDataEncode);
                songDetailData = [songDetailDataEncode];
                //bindImageBgBlur('#songDetailPopup .img-bg-blur-popup', imageBlurSong);
                myPlaylist.option("autoPlay", true);
                myPlaylist.updateQuality(currentSongQuality);
                //myPlaylist.updateCssSelectorAncestor('#magicPlayer');
                myPlaylist.setPlaylist(songDetailData);
                $('#btnSongDetailPlay').hide();
                $('#btnSongDetailPause').show();
                //myPlaylist.updateCssSelectorAncestor('#songDetailPopup');
            } else {
                myPlayer.jPlayer('play');
            }
        });

        $('#btnSongDetailPause').off('click').on('click', function() {
            if (isSongDetailPlaying == true) {
                myPlayer.jPlayer('pause');
                stopPlayerAnimationId('#songDetailPopup');
            }
        });

        $('#ddlSongQuality').on('changed.bs.select', function(e) {
            myPlaylist.setQuality($('#ddlSongQuality').val());
        });
    } else if (isNavigation) {
        // b?t s? ki?n back, next
        isSongDetailPlaying = false;
        var songDetailProcess = $('#songDetailProcess');
        if (songDetailProcess.noUiSlider) {
            // throw new Error('Slider was already initialized.');
            songDetailProcess.noUiSlider.off('update');
            songDetailProcess.noUiSlider.destroy();
        } else {
            songDetailProcess.html('');
        }
        stopPlayerAnimationId('#songDetailPopup');
        songDetailProcess = document.getElementById('songDetailProcess');
        noUiSlider.create(songDetailProcess, {
            start: 0,
            step: 0.1,
            range: {
                'min': 0,
                'max': 100
            }
        });
        $('#btnSongDetailPlay').show().off('click').on('click', function() {
            if (isSongDetailPlaying == false) {
                myPlayer.jPlayer('stop');
                songDetailProcess.noUiSlider.on('update', function(values, handle) {
                    var sp = myPlaylistData.status.seekPercent;
                    if (sp > 0) {
                        // Apply a fix to mp4 formats when the Flash is used.
                        if (fixFlash_mp4) {
                            ignore_timeupdate = true;
                            clearTimeout(fixFlash_mp4_id);
                            fixFlash_mp4_id = setTimeout(function() {
                                ignore_timeupdate = false;
                            }, 1000);
                        }
                        // Move the play-head to the value and factor in the seek percent.
                        myPlayer.jPlayer("playHead", values[handle] * (100 / sp));
                    } else {
                        // Create a timeout to reset this slider to zero.
                        setTimeout(function() {
                            $('#songDetailProcess .noUi-origin').css('left', '0%');
                        }, 0);
                    }
                });
                isSongDetailPlaying = true;
                // Set data play
                // $('#divSongDetailProcess').slideDown(1000);
                songDetailDataEncode = $.base64Decode(songDetailDataEncode);
                songDetailDataEncode = $.parseJSON(songDetailDataEncode);
                songDetailData = [songDetailDataEncode];
                //bindImageBgBlur('#songDetailPopup .img-bg-blur-popup', imageBlurSong);
                myPlaylist.option("autoPlay", true);
                myPlaylist.updateQuality(currentSongQuality);
                //myPlaylist.updateCssSelectorAncestor('#magicPlayer');
                myPlaylist.setPlaylist(songDetailData);
                $('#btnSongDetailPlay').hide();
                $('#btnSongDetailPause').show();
                //myPlaylist.updateCssSelectorAncestor('#songDetailPopup');
            } else {
                myPlayer.jPlayer('play');
            }
        });

        $('#btnSongDetailPause').hide().off('click').on('click', function() {
            if (isSongDetailPlaying == true) {
                myPlayer.jPlayer('pause');
                stopPlayerAnimationId('#songDetailPopup');
            }
        });
    }
}

function stopPlayerAnimation() {
    if (isFixAutoPlay) {
        isFixAutoPlay = false;
    } else {
        isPlaying = false;
        var currentCSA = myPlaylist.getCssSelectorAncestor();
        if ($('#songDetailPopup').length > 0) {
            $('#btnSongDetailPlay').show();
            $('#btnSongDetailPause').hide();
        }
        clearInterval(repeatRotateDocked);
        $(currentCSA + " .imgMusicTool").rotate({
            animateTo: 0,
            callback: function() {}
        });
        $(currentCSA + " " + '.playlistPlayPause:eq(' + myPlaylist.current + ')').removeClass('icon-pause-circle').addClass('icon-play-circle');
    }
}

function stopPlayerAnimationId(divId) {
    clearInterval(repeatRotateDetail);
    $(divId + " .imgMusicTool").rotate({
        animateTo: 0,
        callback: function() {}
    });
}

function startPlayerAnimationId(divId) {
    $(divId + " .imgMusicTool").rotate({
        angle: 0,
        center: ["26px", "26px"],
        animateTo: 28,
        callback: function() {
            var angle = 0;
            clearInterval(repeatRotateDetail);
            repeatRotateDetail = setInterval(function() {
                angle += 10;
                $(divId + " .sub-round-play").rotate(angle);
            }, 30);
            isPlaying = true;
        }
    });
}

var dockedPlayerSongTemplate =
    '<li class="media item-imuzik">' +
    '    <a href="javascript:void(0);" class="link-more" data-target="#popup-docker-player" data-toggle="modal" onclick="functionSharePopupSong(<%this.song_url%>, <%this.song_name_share%>, this, \'<%this.song_slug%>\');"><i class="glyphicon glyphicon-option-vertical"></i></a>' +
    '    <div class="media-left <%this.itemClass%>">' +
    '        <div class="image">' +
    '            <img src="<%this.singer_image%>" width="65" class="media-object">' +
    '            <span class="overlay" href="javascript:void(0);">' +
    '                <a href="javascript:void(0);"><i class="glyphicon icon-play-circle playlistPlayPause"></i></a>' +
    '            </span>' +
    '        </div>' +
    '    </div>' +
    '    <div class="media-body <%this.itemClass%>">' +
    '        <h4 class="media-heading trimtext-popupplayersongname-parent">' +
    '            <a href="javascript:void(0);" class="txt-song trimtext-popupplayersongname" style="white-space:normal"><%this.song_name%></a>' +
    '        </h4>' +
    '        <p><a href="javascript:void(0);" class="txt-singer trimtext-popupplayerssingername"><%this.singer_name%></a></p>' +
    '    </div>' +
    '</li>';

function loadedPlaylist() {
    var playerExpandItemList = $('#playerExpandItemList');
    var listSong = myPlaylist.getPlaylist();
    if (listSong && listSong.length > 0) {
        stopPlayerAnimation();
        var currentCSA = myPlaylist.getCssSelectorAncestor();
        isDockedPlayerHasData = true;
        // if ($('.top-header').length > 0) {
        //     $('#dockedPlayer').show();
        // }
        // setHeightScroll();
        var song = listSong[0];
        $("#playerCurrentSongName").text(song.title);
        $("#playerCurrentSingerName").text(song.artist);
        $("#playerCurrentSingerImg").attr('src', song.poster);
        $(currentCSA + " " + ".playerExpandSongName").text(song.title);
        $(currentCSA + " " + ".playerExpandSingerName").text(song.artist);
        $(currentCSA + " " + ".image-singer-player").attr('src', song.poster);

        bindImageBgBlur(currentCSA + " " + ".playerImageBlur", song.poster_blur);
        //Change playlist icon
        // $('.playlistPlayPause').removeClass('icon-play-circle').removeClass('icon-pause-circle').addClass('icon-play-circle');
        //For marquee song name
        marqueeSong();
        //For cut text
        // cutTextDockPlayerPopup();
        // var childItem = playerExpandItemList.children();
        // if (childItem.length > 1) {
            //            $('#divTabItem').show();
            //            $('.nav-tabs a[href="#divSongList"]').tab('show');
            // playerExpandItemList.children().last().addClass('item-imuzik-last');
            // playerExpandItemList.children().first().addClass('item-imuzik-first');
        // } else {
            //            $('#divTabItem').hide();
            //            $('.nav-tabs a[href="#divPlayerLyric"]').tab('show');
        // }
    }
}

function hidePopupDockedPlayer() {
    $('#body_content').removeClass('disable-scroll').addClass('enable-scroll');
    enableOverScroll($('#body_content'));
    $('#playerCurrentExpanded').hide().removeClass('enable-scroll').addClass('disable-scroll');
    disableOverScroll($('#playerCurrentExpanded'));
    $('#dockedPlayer').show();
    setHeightScroll();
}

function hideAllDockedPlayer() {
    $('#body_content').removeClass('disable-scroll').addClass('enable-scroll');
    enableOverScroll($('#body_content'));
    $('#playerCurrentExpanded').hide().removeClass('enable-scroll').addClass('disable-scroll');
    disableOverScroll($('#playerCurrentExpanded'));
    $('#dockedPlayer').hide();
    isDockedPlayerHasData = false;
    setHeightScroll();
}

// Song Detail
$(document).ready(function() {
    /**
     * huync2: open docker player topic
     */
    $('body').on("click", '#playerCurrentPlaylist', function() {
        //$('body').css('overflow', 'hidden');
        $('#body_content').removeClass('enable-scroll').addClass('disable-scroll');
        disableOverScroll($('#body_content'));
        //$('#playerCurrentExpanded').show().css('overflow', 'auto');
        $('#playerCurrentExpanded').show().removeClass('disable-scroll').addClass('enable-scroll');
        enableOverScroll($('#playerCurrentExpanded'));
        $('#dockedPlayer').hide();
    });
});

function bindImageBgBlur(target, image_blur) {
    if (image_blur) {
        lastBgBlurImg = image_blur;
        $(target).css('background', "url('" + image_blur + "') no-repeat center center fixed")
            //.css('min-height', winHeight)
            .css('background-color', '#2e4263')
            .css('background-size', 'cover')
            .css('-webkit-background-size', 'cover')
            .css('-moz-background-size', 'cover')
            .css('-o-background-size', 'cover')
            .css('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + image_blur + "', sizingMethod='scale')")
            .css('-ms-filter', "\"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + image_blur + "', sizingMethod='scale')\"");
    }
}

/**
 * huync2
 * @param slug
 */
function wireLogSong(slug) {
    return;
    var link = "/write-log-song/" + slug;
    $.ajax({
        type: "GET",
        url: link,
        data: {},
        cache: false,
        success: function(data) {}
    });
}

function wireLogPlaylist(slug) {
    var link = "/write-log-album/" + slug;
    $.ajax({
        type: "GET",
        url: link,
        data: {},
        cache: false,
        success: function(data) {}
    });
}
