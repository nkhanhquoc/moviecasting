/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#productcategories-parent_id').change(function () {
        var val = parseInt($(this).val());
        if (val > 0) {
            $.ajax({
                url: '/product-categories/type',
                type: 'get',
                data: {
                    id: val
                },
                success: function (data) {
                    data = parseInt(data);
                    if (data > 0) {
                        $('#productcategories-display_type option').each(function () {
                            var $this = $(this); // cache this jQuery object to avoid overhead
                            if (parseInt($this.val()) == data) { // if this option's value is equal to our value
                                $this.prop('selected', 'selected'); // select this option
                                $('#productcategories-display_type').prop('disabled', true);
                                return false; // break the loop, no need to look further
                            }
                        });
                    }
                }
            });
        } else {
            $('#productcategories-display_type').prop('disabled', false);
        }
    });

    $('#productcatuserattribute-type').change(function () {
        if (parseInt($(this).val()) == 2) {
            $('#productcatuserattribute-data').prop('disabled', false);
        } else {
            $('#productcatuserattribute-data').prop('disabled', true);
            $('#productcatuserattribute-data').val('');
        }
    });

    $('#videocategory-is_active').click(function () {
        if (!$(this).prop('checked')) {
            if (confirm("Deactive category thì toàn bộ video trong category cũng sẽ deactive\nBạn có chắc muốn thực hiện?")) {
                return true;
            } else {
                $(this).prop('checked', true);
                return;
            }
        }
    });

    $('#vtarticlecategories-is_active').click(function () {
        if (!$(this).prop('checked')) {
            if (confirm("Deactive danh mục thì toàn bộ tin tức trong danh mục cũng sẽ deactive\nBạn có chắc muốn thực hiện?")) {
                return true;
            } else {
                $(this).prop('checked', true);
                return;
            }
        }
    });

    $('#video-active-id').click(function () {
        var ids = '';
        $('input:checkbox:checked').each(function () {
            ids = ids + $(this).val() + ',';
        });
        if (ids != '') {
            if (confirm('Ban co chac muon them?')) {
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var playlist_id = $(this).attr('playlist_id');
                $.ajax({
                    method: "POST",
                    url: "/video-playlist/add-video-to-list",
                    data: {ids: ids, playlist_id: playlist_id, _csrf: csrfToken}
                });
            }
        } else {
            alert('Ban chua chon ban ghi nao!');
        }
    });
    $('a.remove-video-playlist').click(function () {
        if (confirm('Ban co chac muon xoa video nay?')) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });

    $('#approve-video-id').click(function () {
        var ids = '';
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $('input:checkbox:checked').each(function () {
            ids = ids + $(this).val() + ',';
        });
        if (ids != '') {
            if (confirm('Ban co chac muon kiem duyet?')) {
                $.ajax({
                    method: "POST",
                    url: "/video/active",
                    data: {ids: ids, _csrf: csrfToken}
                });
            }
        } else {
            alert('Ban chua chon ban ghi nao!');
        }
    });

    $('#approve-article-id').click(function () {
        var ids = '';
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $('input:checkbox:checked').each(function () {
            ids = ids + $(this).val() + ',';
        });
        if (ids != '') {
            if (confirm('Ban co chac muon kiem duyet?')) {
                $.ajax({
                    method: "POST",
                    url: "/article-items/active",
                    data: {ids: ids, _csrf: csrfToken}
                });
            }
        } else {
            alert('Ban chua chon ban ghi nao!');
        }
    });

    $("ul.mode-select li").click(function(){
        var idLi = $(this).attr('id');
        if ($("li#" + idLi + " span").hasClass("active")) {
            $("li#" + idLi + " span").removeClass("active");
        } else {
            $("li#" + idLi + " span").addClass("active");
        }
    });
});

function setImageUrl(path, url) {
    $('#image_path').val(path);
    $("#img_model_id").attr("src", url);
}

function addVideoToList(listId) {
    $('#video-modal').modal('show').find('#model-content').load('/video-playlist/list?id=' + listId);
}





