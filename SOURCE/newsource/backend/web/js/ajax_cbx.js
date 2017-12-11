/**
 * Created by HoangL on 01-May-16.
 */

$(function () {
    $('.ajax-cbx').each(function (index, item) {
        if ($(item).data('url') && $(item).data('depends')) {
            var depends = $(item).data('depends').split(',');
            var getItems = $(item).data('get-items') ? $(item).data('get-items').split(',') : [];
            $.each(depends, function (index, depend) {
                depend = $("#" + depend);
                depend.change(function () {
                    var selectedDepend = {};
                    $.each(depends, function (i, d) {
                        var val = $("#" + d).val();
                        if (val) {
                            selectedDepend[d] = val;
                        }
                    });
                    if (getItems.length) {
                        $.each(getItems, function (i, d) {
                            var val = $("#" + d).val();
                            if (val) {
                                selectedDepend[d] = val;
                            }
                        });
                    }
                    if (Object.keys(selectedDepend).length) {
                        $.get($(item).data('url'), {'ajax-cbx': selectedDepend}).done(function (data) {
                            data = $.parseJSON(data);
                            $(item).children().remove();
                            if (data['output']) {
                                var selectedVal = $(item).val();
                                var hasKey = false;
                                $.each(data['output'], function (key, value) {
                                    $(item).append($("<option></option>")
                                        .attr("value", key)
                                        .text(value));
                                    if (selectedVal == key) {
                                        hasKey = true;
                                    }
                                });
                                if (hasKey) {
                                    $(item).val(selectedVal)
                                }
                                $(item).trigger("change");
                            }
                        });
                    }
                })
            });
        }
    }).each(function (index, item) {
        if ($(item).data('url') && $(item).data('depends')) {
            var depends = $(item).data('depends').split(',');
            var getItems = $(item).data('get-items') ? $(item).data('get-items').split(',') : [];
            var selectedDepend = {};
            var hasValued = true;
            $.each(depends, function (i, d) {
                var val = $("#" + d).val();
                if (val) {
                    selectedDepend[d] = val;
                } else {
                    hasValued = false;
                }
            });
            if (getItems.length) {
                $.each(getItems, function (i, d) {
                    var val = $("#" + d).val();
                    if (val) {
                        selectedDepend[d] = val;
                    } else {
                        hasValued = false;
                    }
                });
            }
            if (Object.keys(selectedDepend).length && hasValued) {
                $.get($(item).data('url'), {'ajax-cbx': selectedDepend}).done(function (data) {
                    data = $.parseJSON(data);
                    $(item).children().remove();
                    if (data['output']) {
                        var hasKey = false;
                        var selectedVal = $(item).val();
                        $.each(data['output'], function (key, value) {
                            $(item).append($("<option></option>")
                                .attr("value", key)
                                .text(value));
                            if (selectedVal == key) {
                                hasKey = true;
                            }
                        });
                        if (hasKey) {
                            $(item).val(selectedVal)
                        }
                        $(item).trigger("change");
                    }
                });
            }
        }
    });
});
