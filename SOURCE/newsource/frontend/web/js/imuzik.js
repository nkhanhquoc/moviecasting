var screenWindow = window.innerWidth;
var screenWindowH = window.innerHeight;
var scrollDivs = [];

$(function () {
    cutOffText();
    //-------------jscroll panel-----------------
    if (screenWindow > 640) {//This condition only for web
        $('.scroll-pane').jScrollPane();
        $('.scroll-pane').each(function () {
            scrollDivs.push($(this).jScrollPane().data().jsp);
        });
        $('.owl-carousel').css("display", "block");

        $(".open-popup").click(function () {
            //alert("Ok");
            $(".player-bar .box-playing").toggleClass("show-box");
        });

    } else {
        buildSilder('.owl-carousel', 2);
        $(".scroll-mobile").addClass("modal fade");
        $(".scroll-mobile-sub-1").addClass("modal-dialog modal-sm");
        $(".scroll-mobile-sub-2").addClass("modal-content");
        $(".scroll-mobile .mdl-links").css("height", screenWindowH - 65);
        $(".player-bar .box-playing .list-group-item .wrap-text").css("width", screenWindow - 55);
        $(".player-bar .link-more-mobile").click(function () {
            $(".player-bar .box-playing").toggleClass("show-box");
        });
        $(".mdl-songs .media-body").css("width", screenWindow - 97);//97 = width of images + icon more + four gap
    }
    viewLesFull();
    searchImuzik();
});

$(window).resize(function () {//This condition only for web
    screenWindow = window.innerWidth;
    if (screenWindow > 640) {//This condition only for web
        $('.scroll-pane').each(function () {
            scrollDivs.push($(this).jScrollPane().data().jsp);
        });
        $('.owl-carousel').owlCarousel('destroy');
        $('.owl-carousel').css("display", "block");
        $(".open-popup").click(function () {
            $(".player-bar .box-playing").toggleClass("show-box");
        });
    } else {
        $('.owl-carousel').owlCarousel('destroy');
        buildSilder('.owl-carousel', 2);
        $(".scroll-mobile").addClass("modal fade");
        $(".scroll-mobile-sub-1").addClass("modal-dialog modal-sm");
        $(".scroll-mobile-sub-2").addClass("modal-content");
        $(".scroll-mobile .mdl-links").css("height", screenWindowH - 65);
        $(".player-bar .box-playing .list-group-item .wrap-text").css("width", screenWindow - 55);
        $(".player-bar .link-more-mobile").click(function () {
            $(".player-bar .box-playing").toggleClass("show-box");
        });
        $(".mdl-songs .media-body").css("width", screenWindow - 97);//97 = width of images + icon more + four gap

        if (scrollDivs.length) {
            $.each(
                scrollDivs,
                function (i) {
                    this.destroy();
                }
            );
            scrollDivs = [];
        }
    }
    cutOffText();
    setWidthBoxPlaying();
});

//-------------------View full, view less		
function viewLesFull() {
    $(".view-full-article").click(function (e) {
        $(".less-article").toggleClass("full-article");
        $(".full-link").toggleClass("off");
        $(".less-link").toggleClass("on");
    });
}

//-------------------Only for ellipsis class of module .media
function cutOffText() {
    var objectWidth = $(".media").outerWidth() - ($(".media-left").outerWidth() + $(".media-right").outerWidth());
    var objectWidth2 = $(".media").outerWidth() - ($(".media-left").outerWidth() +
        $(".mdl-billboard .media-right").outerWidth());

    $(".mdl-song-nominations .ellipsis").css("width", objectWidth);
    $(".mdl-billboard .ellipsis").css("width", objectWidth2);
}

//----------------------Slide item	
function buildSilder(clazz, numItem) {
    $(clazz).owlCarousel({
        stagePadding: 15,
        loop: false,
        dots: false,
        margin: -5,
        nav: false,
        dotData: false,
        lazyLoad: true,
        smartSpeed: 500,
        responsive: {
            0: {
                items: numItem
            },
            400: {
                items: 3
            },
            610: {
                items: 4
            }
        }
    });
}

//----------------------Search
function searchImuzik() {
    $(".btn-search").click(function () {
        var heightBody = $(window).height();
        $(".popup-search").toggle(0, function () {
            $(".container").css({"height": heightBody, "overflow": "hidden"});
        });

    });

    $("#closeBox").click(function () {
        $(".popup-search").hide(20);
        $(".container").css({"height": "inherit", "overflow": "inherit"});
    });

    $(".ipt-search").focus(function () {
        $(".box-search-suggess").toggle(50);
    });

    $("#clearSuggess").click(function () {
        $(".box-search-suggess").hide();
    });
}
//-------------------Set width for box-playing in player-bar
function setWidthBoxPlaying() {
    var widthParent = $(".player-bar .box-playing").width();
    $(".player-bar .box-playing .list-group-item .wrap-text").css("width", widthParent - 103);
    $(".player-bar .link-more-mobile").click(function () {
        $(".player-bar .box-playing").toggleClass("show-box");
    });
}