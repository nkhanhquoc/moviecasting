function processXhrResponse(xhr) {
    console.log(xhr);

    if (xhr.status == 401)
        // Xac thuc
        window.location = window.location;
    else if (xhr.status == 200) {
        $('.modal').modal('hide');
        var jsonResponse = JSON.parse(xhr.responseText);
        toastr.warning(jsonResponse.message);
    }
    else if (xhr.status == 201) {
        $('.modal').modal('hide');
        var jsonResponse = JSON.parse(xhr.responseText);
        toastr.warning(jsonResponse.message);
    }
    else if (xhr.status == 400 || xhr.status == 404){
        toastr.warning('Dữ liệu không hợp lệ!')
        $('.modal .modal-body').html(xhr.responseText);
    }
    else {
        // $('#waiting').hide();
        $('.modal').modal('hide');
        toastr.warning('Lỗi hệ thống!');
    }

}

function toggleCampaignItems(type) {
    $('.campaign-items').hide();
    if (type == '0') {
        $('#data-items').show();
    } else {
        $('#access-items').show();
    }
}

$(document).ready(function () {
    // Kich hoat /dung chien dich
    $('.modal-content').on("click", "#active-agree-btn", function () {
        var reason = $('#active-reason').val();
        if (!reason) {
            $('#active-reason').css('border', '1px solid red')
            return false;
        }

        $.ajax({
            url:  '/campaign/active?id=' + $('#campaign-id').val() +'&action=' + $('#c-action').val(),
            data: {

                'reason': reason
            },
            method: 'POST',
            dataType: 'json',
            // "sucess" will be executed only if the response status is 200 and get a JSON
            success: function (json) {
                console.log(json);
                if (typeof json.error != 'undefined' ) {
                    toastr.info(json.message);
                } else {
                    toastr.info(json.message);
                    console.log(json.object.status);
                    window.location = window.location;
                }

                $('.modal').modal('hide');
            },
            // "error" will run but receive state 200, but if you miss the JSON syntax
            error: function (xhr) {
                if (xhr.status == 400 || xhr.status == 404){
                    toastr.warning('Dữ liệu không hợp lệ!')
                    $('.modal .modal-content').html(xhr.responseText);
                } else
                    processXhrResponse(xhr);
            }
        });
    });


    toggleCampaignItems($('#campaign-campaign_type').val());
    $('#campaign-campaign_type').on("change", function () {
        toggleCampaignItems($(this).val());
    })


    $("#campaignWebsiteModal").on("show.bs.modal", function(e) {
        $(".modal-body", $(this)).html('');
        $(".modal-body", $(this)).load( $('#campaignWebsiteModal').attr('vthref'));
    });

    $("#website-list").on("click", ".website-edit-action", function() {
        var url = $(this).attr('vthref');
        var modalBody = $("#updateCampaignWebsiteModal .modal-body");
        modalBody.html('');
        modalBody.load(url);
        $("#updateCampaignWebsiteModal").modal();
    });

    $('.submit-data-btn').on('click', function () {
        var formObj = $('form',$(this).parent().parent());

        var formData = new FormData();
        $.each( $('#campaign-website-form').serializeArray(), function( key, field ) {
            formData.append( field.name, field.value);
        });

        // Goi ajax create/update website
        $.ajax({
            url: formObj.attr('action') ,
            data: formObj.serializeArray(),
            method: 'POST',
            dataType: 'json',
            // "sucess" will be executed only if the response status is 200 and get a JSON
            success: function (json) {
                console.log(json);
                if (typeof json.error != 'undefined' ) {
                    toastr.info(json.message);
                } else {
                    toastr.info(json.message);
                    $('#website-list').load($('#website-list').attr('vthref'));
                }

                $('.modal').modal('hide');
            },
            // "error" will run but receive state 200, but if you miss the JSON syntax
            error: function (xhr) {
                processXhrResponse(xhr);
            }
        });

    });

});
