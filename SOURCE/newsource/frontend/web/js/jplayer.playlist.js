/*
 * Playlist Object for the jPlayer Plugin
 * http://www.jplayer.org
 *
 * Copyright (c) 2009 - 2014 Happyworm Ltd
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/MIT
 *
 * Author: Mark J Panaghiston
 * Version: 2.4.1
 * Date: 19th November 2014
 *
 * Edited by HoangL
 * Version: 2.4.1.1
 * Date: 22th October 2015
 *
 * Requires:
 *  - jQuery 1.7.0+
 *  - jPlayer 2.8.2+
 */

/*global jPlayerPlaylist:true */

(function($, undefined) {

    jPlayerPlaylist = function(cssSelector, playlist, options) {
        var self = this;

        this.current = 0;
        this.loop = false; // Flag used with the jPlayer repeat event
        this.shuffled = false;
        this.removing = false; // Flag is true during remove animation, disabling the remove() method until complete.
        this.quality = "128kbs"; // Default quality of music
        this.currentSongQuality = ''; // Quality of music that playing
        this.listQuality = ['128kbs', '320kbs', '500kbs']; // Quality of music that playing
        this.defaultType = 'mp3'; // Quality of music that playing
        this.lyricPanel = '';

        this.cssSelector = $.extend({}, this._cssSelector, cssSelector); // Object: Containing the css selectors for jPlayer and its cssSelectorAncestor
        this.options = $.extend(true, {
            keyBindings: {
                next: {
                    key: 221, // ]
                    fn: function() {
                        self.next();
                    }
                },
                previous: {
                    key: 219, // [
                    fn: function() {
                        self.previous();
                    }
                },
                shuffle: {
                    key: 83, // s
                    fn: function() {
                        self.shuffle();
                    }
                }
            },
            stateClass: {
                shuffled: "jp-state-shuffled"
            }
        }, this._options, options); // Object: The jPlayer constructor options for this playlist and the playlist options

        this.quality = this.options.playlistOptions.quality;
        this.listQuality = this.options.playlistOptions.listQuality;
        this.defaultType = this.options.playlistOptions.defaultType;
        this.lyricPanel = this.cssSelector.cssSelectorAncestor + " " + this.options.playlistOptions.lyricPanel;
        this.playlist = []; // Array of Objects: The current playlist displayed (Un-shuffled or Shuffled)
        this.original = []; // Array of Objects: The original playlist

        this._initPlaylist(playlist); // Copies playlist to this.original. Then mirrors this.original to this.playlist. Creating two arrays, where the element pointers match. (Enables pointer comparison.)

        // Setup the css selectors for the extra interface items used by the playlist.
        this.cssSelector.details = this.cssSelector.cssSelectorAncestor + " .jp-details"; // Note that jPlayer controls the text in the title element.
        this.cssSelector.playlist = this.cssSelector.cssSelectorAncestor + " .jp-playlist";
        this.cssSelector.next = this.cssSelector.cssSelectorAncestor + " .jp-next";
        this.cssSelector.previous = this.cssSelector.cssSelectorAncestor + " .jp-previous";
        this.cssSelector.shuffle = this.cssSelector.cssSelectorAncestor + " .jp-shuffle";
        this.cssSelector.shuffleOff = this.cssSelector.cssSelectorAncestor + " .jp-shuffle-off";

        // Override the cssSelectorAncestor given in options
        this.options.cssSelectorAncestor = this.cssSelector.cssSelectorAncestor;

        // Override the default repeat event handler
        this.options.repeat = function(event) {
            self.loop = event.jPlayer.options.loop;
        };

        // Create a ready event handler to initialize the playlist
        $(this.cssSelector.jPlayer).bind($.jPlayer.event.ready, function() {
            self._init();
        });

        // Create an ended event handler to move to the next item
        $(this.cssSelector.jPlayer).bind($.jPlayer.event.ended, function() {
            self.next();
        });

        // Create a play event handler to pause other instances
        $(this.cssSelector.jPlayer).bind($.jPlayer.event.play, function() {
            $(this).jPlayer("pauseOthers");
        });

        // Create a resize event handler to show the title in full screen mode.
        $(this.cssSelector.jPlayer).bind($.jPlayer.event.resize, function(event) {
            if (event.jPlayer.options.fullScreen) {
                $(self.cssSelector.details).show();
            } else {
                $(self.cssSelector.details).hide();
            }
        });

        // Create click handlers for the extra buttons that do playlist functions.
        $(this.cssSelector.previous).click(function(e) {
            e.preventDefault();
            self.previous();
            self.blur(this);
        });

        $(this.cssSelector.next).click(function(e) {
            e.preventDefault();
            self.next();
            self.blur(this);
        });

        $(this.cssSelector.shuffle).click(function(e) {
            e.preventDefault();
            if (self.shuffled && $(self.cssSelector.jPlayer).jPlayer("option", "useStateClassSkin")) {
                self.shuffle(false);
            } else {
                self.shuffle(true);
            }
            self.blur(this);
            if(self.playlist.length > 0){
              $(self.cssSelector.shuffle).hide();
              $(self.cssSelector.shuffleOff).show();
            }
        });
        $(this.cssSelector.shuffleOff).click(function(e) {
            e.preventDefault();
            self.shuffle(false);
            self.blur(this);
            $(self.cssSelector.shuffleOff).hide();
            $(self.cssSelector.shuffle).show();

        }).hide();

        // Put the title in its initial display state
        if (!this.options.fullScreen) {
            $(this.cssSelector.details).hide();
        }

        // Remove the empty <li> from the page HTML. Allows page to be valid HTML, while not interfereing with display animations
        $(this.cssSelector.playlist + " ul").empty();

        // Create .on() handlers for the playlist items along with the free media and remove controls.
        this._createItemHandlers();

        // Instance jPlayer
        $(this.cssSelector.jPlayer).jPlayer(this.options);
    };

    jPlayerPlaylist.prototype = {
        _cssSelector: { // static object, instanced in constructor
            jPlayer: "#jquery_jplayer_1",
            cssSelectorAncestor: "#jp_container_1"
        },
        _options: { // static object, instanced in constructor
            playlistOptions: {
                autoPlay: false,
                loopOnPrevious: false,
                shuffleOnLoop: true,
                enableRemoveControls: false,
                displayTime: 'slow',
                addTime: 'fast',
                removeTime: 'fast',
                shuffleTime: 'slow',
                itemClass: "jp-playlist-item",
                freeGroupClass: "jp-free-media",
                freeItemClass: "jp-playlist-item-free",
                removeItemClass: "jp-playlist-item-remove",
                functionLoadedPlaylist: ""
                    //quality: "128kbs",
                    //listQuality: ['128kbs', '320kbs', '500kbs'],
                    //defaultType: 'mp3'
            }
        },
        option: function(option, value) { // For changing playlist options only
            if (value === undefined) {
                return this.options.playlistOptions[option];
            }

            this.options.playlistOptions[option] = value;

            switch (option) {
                case "enableRemoveControls":
                    this._updateControls();
                    break;
                case "itemClass":
                case "freeGroupClass":
                case "freeItemClass":
                case "removeItemClass":
                    this._refresh(true); // Instant
                    this._createItemHandlers();
                    break;
            }
            return this;
        },
        _init: function() {
            var self = this;
            this._refresh(function() {
                if (self.options.playlistOptions.autoPlay) {
                    self.play(self.current);
                } else {
                    self.select(self.current);
                }
            });
        },
        _initPlaylist: function(playlist) {
            this.current = 0;
            this.shuffled = false;
            this.removing = false;
            this.original = $.extend(true, [], playlist); // Copy the Array of Objects
            this._originalPlaylist();
        },
        _originalPlaylist: function() {
            var self = this;
            this.playlist = [];
            // Make both arrays point to the same object elements. Gives us 2 different arrays, each pointing to the same actual object. ie., Not copies of the object.
            $.each(this.original, function(i) {
                self.playlist[i] = self.original[i];
            });
        },
        _refresh: function(instant) {
            /* instant: Can be undefined, true or a function.
             *	undefined -> use animation timings
             *	true -> no animation
             *	function -> use animation timings and excute function at half way point.
             */
            var self = this;

            if (instant && !$.isFunction(instant)) {
                $(this.cssSelector.playlist + " ul").empty();
                // $.each(this.playlist, function(i) {
                //     $(self.cssSelector.playlist + " ul").append(self._createListItem(self.playlist[i]));
                // });
                this._updateControls();
            } else {
                var displayTime = $(this.cssSelector.playlist + " ul").children().length ? this.options.playlistOptions.displayTime : 0;

                $(this.cssSelector.playlist + " ul").slideUp(displayTime, function() {
                    var $this = $(this);
                    $(this).empty();
                    // khanhnq16 - Tam thoi bo phan hien thi html item vao player
                    // $.each(self.playlist, function(i) {
                    //     $this.append(self._createListItem(self.playlist[i]));
                    // });
                    self._updateControls();
                    if ($.isFunction(instant)) {
                        instant();
                    }
                    if (self.playlist.length) {
                        $(this).slideDown(self.options.playlistOptions.displayTime);
                    } else {
                        $(this).show();
                    }
                });
            }
        },
        _createListItem: function(media) {
            //var self = this;
            //var fixXssContent = $("fixXssContent");
            return TemplateEngine(dockedPlayerSongTemplate, {
                singer_image: media.poster,
                song_name: $("<div>").text(media.title).html(),
                singer_name: $("<div>").text(media.artist).html(),
                itemClass: this.options.playlistOptions.itemClass,
                song_url: $("<div>").text("'" + media.song_url + "'").html(),
                song_name_share: $("<div>").text("'" + addslashes(media.title) + "-" + media.artist + "'").html(),
                song_slug: media.slug,
            });
        },
        _createItemHandlers: function() {
            var self = this;
            // console.log(this.cssSelector.playlist);
            // Create live handlers for the playlist items
            // console.log(this.cssSelector.playlist);
            $(this.cssSelector.playlist).off("click", "div." + this.options.playlistOptions.itemClass).on("click", "div." + this.options.playlistOptions.itemClass, function(e) {
                e.preventDefault();
                var index = $(this).parent().index();
                if (self.current !== index) {
                    self.play(index);
                } else {
                    $(self.cssSelector.jPlayer).jPlayer("play");
                }
                self.blur(this);
            });
        },
        _updateControls: function() {
            if (this.options.playlistOptions.enableRemoveControls) {
                $(this.cssSelector.playlist + " ." + this.options.playlistOptions.removeItemClass).show();
            } else {
                $(this.cssSelector.playlist + " ." + this.options.playlistOptions.removeItemClass).hide();
            }

            if (this.shuffled) {
                $(this.cssSelector.jPlayer).jPlayer("addStateClass", "shuffled");
            } else {
                $(this.cssSelector.jPlayer).jPlayer("removeStateClass", "shuffled");
            }
            if ($(this.cssSelector.shuffle).length && $(this.cssSelector.shuffleOff).length) {
                if (this.shuffled) {
                    $(this.cssSelector.shuffleOff).show();
                    $(this.cssSelector.shuffle).hide();
                } else {
                    $(this.cssSelector.shuffleOff).hide();
                    $(this.cssSelector.shuffle).show();
                }
            }
            if (this.options.playlistOptions.functionLoadedPlaylist) {
                var functionLoadedPlaylist = window[this.options.playlistOptions.functionLoadedPlaylist];
                if (typeof functionLoadedPlaylist === 'function') {
                    functionLoadedPlaylist();
                }
            }
        },
        _highlight: function(index) {
            if (this.playlist.length && index !== undefined) {
                $(this.cssSelector.playlist + " .jp-playlist-current").removeClass("jp-playlist-current");
                $(this.cssSelector.playlist + " li:nth-child(" + (index + 1) + ")").addClass("jp-playlist-current").find(".jp-playlist-item").addClass("jp-playlist-current");
                // $(this.cssSelector.details + " li").html("<span class='jp-title'>" + this.playlist[index].title + "</span>" + (this.playlist[index].artist ? " <span class='jp-artist'>by " + this.playlist[index].artist + "</span>" : ""));
            }
        },
        setPlaylist: function(playlist) {
            this._initPlaylist(playlist);
            this._init();
        },
        loadPlaylistJson: function(url) {
            var self = this;
            $.ajax({
                method: "GET",
                url: url
            }).done(function(data) {
                if (data && $.isArray(data) && data.length > 0) {
                    self.setPlaylist(data);
                }
            });
        },
        add: function(media, playNow) {
          //khanhnq16 - tam thoi bo add html
            // $(this.cssSelector.playlist + " ul").append(this._createListItem(media)).find("li:last-child").hide().slideDown(this.options.playlistOptions.addTime);
            this._updateControls();
            this.original.push(media);
            this.playlist.push(media); // Both array elements share the same object pointer. Comforms with _initPlaylist(p) system.

            if (playNow) {
                this.play(this.playlist.length - 1);
            } else {
                if (this.original.length === 1) {
                    this.select(0);
                }
            }
        },
        remove: function(index) {
            var self = this;

            if (index === undefined) {
                this._initPlaylist([]);
                this._refresh(function() {
                    $(self.cssSelector.jPlayer).jPlayer("clearMedia");
                });
                return true;
            } else {

                if (this.removing) {
                    return false;
                } else {
                    index = (index < 0) ? self.original.length + index : index; // Negative index relates to end of array.
                    if (0 <= index && index < this.playlist.length) {
                        this.removing = true;

                        $(this.cssSelector.playlist + " li:nth-child(" + (index + 1) + ")").slideUp(this.options.playlistOptions.removeTime, function() {
                            $(this).remove();

                            if (self.shuffled) {
                                var item = self.playlist[index];
                                $.each(self.original, function(i) {
                                    if (self.original[i] === item) {
                                        self.original.splice(i, 1);
                                        return false; // Exit $.each
                                    }
                                });
                                self.playlist.splice(index, 1);
                            } else {
                                self.original.splice(index, 1);
                                self.playlist.splice(index, 1);
                            }

                            if (self.original.length) {
                                if (index === self.current) {
                                    self.current = (index < self.original.length) ? self.current : self.original.length - 1; // To cope when last element being selected when it was removed
                                    self.select(self.current);
                                } else if (index < self.current) {
                                    self.current--;
                                }
                            } else {
                                $(self.cssSelector.jPlayer).jPlayer("clearMedia");
                                self.current = 0;
                                self.shuffled = false;
                                self._updateControls();
                            }

                            self.removing = false;
                        });
                    }
                    return true;
                }
            }
        },
        select: function(index) {
            index = (index < 0) ? this.original.length + index : index; // Negative index relates to end of array.
            if (0 <= index && index < this.playlist.length) {
                this.current = index;
                this._highlight(index);
                // Update for quality
                var newItem = convertPlaylistToSong(this.playlist[this.current], this.quality, this.listQuality, this.defaultType);
                this.currentSongQuality = newItem[0];
                //var currentMedia = $(this.cssSelector.jPlayer).data("jPlayer").status.media;
                //if (!compareJson(currentMedia, newItem[1])) {
                $(this.cssSelector.jPlayer).jPlayer("setMedia", newItem[1]);
                if ($(this.lyricPanel).length > 0 && newItem[1]['lyrics']) {
                    $(this.lyricPanel).html(newItem[1]['lyrics']);
                } else {
                    $(this.lyricPanel).html('');
                }
                //}
            } else {
                this.current = 0;
            }
        },
        play: function(index) {
            index = (index < 0) ? this.original.length + index : index; // Negative index relates to end of array.
            if (0 <= index && index < this.playlist.length) {
                if (this.playlist.length) {
                    this.select(index);
                    $(this.cssSelector.jPlayer).jPlayer("play");
                }
            } else if (index === undefined) {
                $(this.cssSelector.jPlayer).jPlayer("play");
            }
        },
        pause: function() {
            $(this.cssSelector.jPlayer).jPlayer("pause");
        },
        next: function() {
          //khanhnq16 - sua next khi suffle
          if(this.shuffled){
            var index = Math.floor(Math.random()*this.playlist.length);
          } else {
            var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
          }

          if (this.loop) {
              // See if we need to shuffle before looping to start, and only shuffle if more than 1 item.
              if (index === 0 && this.shuffled && this.options.playlistOptions.shuffleOnLoop && this.playlist.length > 1) {
                  this.shuffle(true, true); // playNow
              } else {
                  this.play(index);
              }
          } else {
              // The index will be zero if it just looped round
              if (index > 0) {
                  this.play(index);
              }
          }
        },
        previous: function() {
            var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;

            if (this.loop && this.options.playlistOptions.loopOnPrevious || index < this.playlist.length - 1) {
                this.play(index);
            }
        },
        shuffle: function(shuffled, playNow) {
            var self = this;
            if (shuffled === undefined) {
                shuffled = !this.shuffled;
            }
            if (shuffled || shuffled !== this.shuffled) {
                self.shuffled = shuffled;
                //khanhnq16 sua lai
                // if (playNow || !$(self.cssSelector.jPlayer).data("jPlayer").status.paused) {
                if (playNow || $(self.cssSelector.jPlayer).data("jPlayer").status.paused) {
                    self.play(0);
                }
                // $(this.cssSelector.playlist + " ul").slideUp(this.options.playlistOptions.shuffleTime, function() {
                    // if (shuffled) {
                    //     self.playlist.sort(function() {
                    //         return 0.5 - Math.random();
                    //     });
                    // } else {
                    //     self._originalPlaylist();
                    // }
                    // self._refresh(true); // Instant


                    // else {
                    //     self.select(0);
                    // }
                    // $(this).slideDown(self.options.playlistOptions.shuffleTime);
                // });
            }
        },
        blur: function(that) {
            if ($(this.cssSelector.jPlayer).jPlayer("option", "autoBlur")) {
                $(that).blur();
            }
        },
        getPlaylist: function() {
            return this.playlist;
        },
        getPlaylistLength: function() {
            return this.playlist.length;
        },
        getCurrentQualitySong: function() {
            return this.currentSongQuality;
        },
        updateQuality: function(newQuality) {
            if (this.quality != newQuality) {
                this.quality = newQuality;
            }
        },
        setQuality: function(newQuality) {
            var self = this;
            if (this.quality != newQuality) {
                var currentTime = 0;
                this.quality = newQuality;
                var jPlayer = $(self.cssSelector.jPlayer);

                if (jPlayer.data("jPlayer").status.paused === true) {
                    //$(this.cssSelector.).jPlayer("setMedia", newItem[1]);
                    currentTime = jPlayer.data("jPlayer").status.currentTime;
                    self.select(this.current);
                    jPlayer.jPlayer("pause", currentTime);
                } else if (jPlayer.data("jPlayer").status.paused === false && jPlayer.data("jPlayer").status.currentTime > 0) {
                    jPlayer.jPlayer("pause");
                    currentTime = jPlayer.data("jPlayer").status.currentTime;
                    self.select(this.current);
                    jPlayer.jPlayer("play", currentTime);
                } else {
                    self.select(this.current);
                }
            }
        },
        upQuality: function() {
            //this.playlist[this.current];
            // get current quality list
            var listQuality = this.playlist[this.current]['quality_list'];
            // quality
            if (!$.isArray(listQuality) || listQuality.length <= 1) {
                return false;
            } else {
                // get current index of quality
                var idx = listQuality.indexOf(this.quality);
                if (idx > 0) {
                    while (idx > 0) {
                        idx--;
                        this.setQuality(listQuality[idx]);
                    }
                }
                return false;
            }
        },
        downQuality: function() {
            var listQuality = this.playlist[this.current]['quality_list'];
            // quality
            if (!$.isArray(listQuality) || listQuality.length <= 1) {
                return false;
            } else {
                // get current index of quality
                var idx = listQuality.indexOf(this.quality);
                if (idx >= 0 && idx != listQuality.length - 1) {
                    while (idx < listQuality.length) {
                        idx++;
                        this.setQuality(listQuality[idx]);
                    }
                }
                return false;
            }
        },
        getCssSelectorAncestor: function() {
            return this.cssSelector.cssSelectorAncestor;
        },
        updateCssSelectorAncestor: function(newCssSelectorAncestor) {
            //.unbind("click");
            // unbind old event
            var self = this;
            $(this.cssSelector.previous).unbind("click");
            $(this.cssSelector.next).unbind("click");
            $(this.cssSelector.shuffle).unbind("click");
            $(this.cssSelector.shuffleOff).unbind("click");

            this.cssSelector.cssSelectorAncestor = newCssSelectorAncestor;
            // Setup the css selectors for the extra interface items used by the playlist.
            this.cssSelector.details = this.cssSelector.cssSelectorAncestor + " .jp-details"; // Note that jPlayer controls the text in the title element.
            this.cssSelector.playlist = this.cssSelector.cssSelectorAncestor + " .jp-playlist";
            this.cssSelector.next = this.cssSelector.cssSelectorAncestor + " .jp-next";
            this.cssSelector.previous = this.cssSelector.cssSelectorAncestor + " .jp-previous";
            this.cssSelector.shuffle = this.cssSelector.cssSelectorAncestor + " .jp-shuffle";
            this.cssSelector.shuffleOff = this.cssSelector.cssSelectorAncestor + " .jp-shuffle-off";

            // Override the cssSelectorAncestor given in options
            this.options.cssSelectorAncestor = this.cssSelector.cssSelectorAncestor;

            // Create click handlers for the extra buttons that do playlist functions.
            $(this.cssSelector.previous).click(function(e) {
                e.preventDefault();
                self.previous();
                self.blur(this);
            });

            $(this.cssSelector.next).click(function(e) {
                e.preventDefault();
                self.next();
                self.blur(this);
            });

            // $(this.cssSelector.shuffle).click(function(e) {
            //     e.preventDefault();
            //     if (self.shuffled && $(self.cssSelector.jPlayer).jPlayer("option", "useStateClassSkin")) {
            //         self.shuffle(false);
            //     } else {
            //         self.shuffle(true);
            //     }
            //     self.blur(this);
            // });

            // $(this.cssSelector.shuffleOff).click(function(e) {
            //     e.preventDefault();
            //     self.shuffle(false);
            //     self.blur(this);
            // }).hide();

            $(this.cssSelector.jPlayer).jPlayer("option", "cssSelectorAncestor", newCssSelectorAncestor);
        }
    };
})(jQuery);

/**
 * Convert Playlist multi quality to jplay one quality with selected quality
 * @param playlistItem
 * @param current
 * @param listQuality
 * @param defaultType
 * @returns {*[]}
 */
function convertPlaylistToSong(playlistItem, current, listQuality, defaultType) {
    if (typeof(defaultType) === "undefined") {
        defaultType = 'mp3';
    }
    if (typeof(listQuality) === "undefined") {
        listQuality = ['500kbs', '320kbs', '256kbs', '128kbs'];
    }
    var song = [];
    var ext;
    var quality = '';
    $.each(playlistItem, function(key, value) {
        if (key == 'quality_path') {
            listQuality = playlistItem['quality_list'];
            // check json object
            if (value && typeof value == 'object') {
                var selectItem = null;
                if (value[current]) {
                    selectItem = value[current];
                    quality = current;
                } else if (value.length == 1) {
                    $.each(value, function(k, v) {
                        quality = k;
                        selectItem = v;
                        return false;
                    });
                } else {
                    // find lower quality
                    listQuality = playlistItem['quality_list'];
                    var idx = listQuality.indexOf(current);
                    if (idx != listQuality.length - 1) {
                        while (idx < listQuality.length) {
                            idx++;
                            var downQuality = listQuality[idx];
                            if (value[downQuality]) {
                                selectItem = value[downQuality];
                                quality = downQuality;
                                break;
                            }
                        }
                    }
                    // allow get first quality
                    if (selectItem == null) {
                        $.each(value, function(k, v) {
                            quality = k;
                            selectItem = v;
                            return false;
                        });
                    }
                }
                if (selectItem) {
                    // check json object
                    if (typeof selectItem == 'object') {
                        if (selectItem['format'] && selectItem['url']) {
                            song[selectItem['format']] = selectItem['url'];
                        } else if (selectItem['format']) {
                            song[selectItem['format']] = '';
                        } else if (selectItem['url']) {
                            // substring, get extension
                            ext = getFileExtension(selectItem['url']);
                            if (ext) {
                                song[ext] = selectItem['url'];
                            } else {
                                // return null
                                song[defaultType] = '';
                            }
                        }
                    } else if (typeof selectItem == 'string') {
                        // If not array => it can be a string
                        if (selectItem) {
                            // substring, get extension
                            ext = getFileExtension(selectItem);
                            if (ext) {
                                song[ext] = selectItem;
                            } else {
                                // return null
                                song[defaultType] = '';
                            }
                        } else {
                            // return null
                            song[defaultType] = '';
                        }
                    }
                }
            } else if (typeof value == 'string') {
                // If not array => it can be a string
                if (value) {
                    // substring, get extension
                    ext = getFileExtension(value);
                    if (ext) {
                        song[ext] = value;
                    } else {
                        // return null
                        song[defaultType] = '';
                    }
                } else {
                    // return null
                    song[defaultType] = '';
                }
            }
        } else {
            song[key] = value;
        }
    });
    return [quality, song];
}
