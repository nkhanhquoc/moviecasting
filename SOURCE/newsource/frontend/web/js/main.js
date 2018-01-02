// JavaScript Document
(function ($, win) {
    var wWidth = $(win).width(),
            wHeight = $(win).height();
    $(win).load(function () {
        $('[data-selectize]').each(function () {
            $(this).selectize();
        });
    });

    $(function () {
        $('.insert-links').each(function (index, element) {
            var $this = $(this),
                    $linkwrapper = $this.find('.links-list'),
                    $addLink = $this.find('button[type="button"]'),
                    $inputLink = $this.find('input[type="text"]');
            $addLink.on('click', function (e) {
                e.preventDefault();
                if ($inputLink.val() != '' && !$linkwrapper.find('input[value="' + $inputLink.val() + '"]')[0]) {
                    $linkwrapper.append('<span class="link-item"><i class="icons icon-delete">&times;</i><input type="hidden" value="' + $inputLink.val() + '" /> <a href="#">' + $inputLink.val() + '</a>');
                }
            });
        });
        $('.insert-links').on('click', '.icon-delete', function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.photo-upload').find('.upload-thumb').html('<i class="icons icon-delete">&times;</i><img src=' + e.target.result + ' />');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.photo-upload input[type="file"]').on('change', function (e) {
            readURL(this);
        });
        $('.photo-upload').each(function (index, element) {
            var $this = $(this),
                    $uploadImage = $this.find('button');
            $inputImage = $this.find('input[type="file"]');
            $uploadImage.on('click', function (e) {
                e.preventDefault();
                $inputImage.trigger('click');
            });
        });
        $('.photo-upload').on('click', '.icon-delete', function (e) {
            e.preventDefault();
            $(this).parent().html('');
        });
    });


}(jQuery, window));

$().ready(function () {
    $('#register-form').validationEngine();
    $('#contact-form').validationEngine();

});

function loadMore(url, container, idpage) {
    var page = $('#' + idpage).val();
    $.get(url + page, function (data, status) {
        var json = JSON.parse(data);
        $('#'+idpage).val(json.page);
        $('#'+container).append(json.text);
    });
}