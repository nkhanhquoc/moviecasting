$(document).ready(function () {
	// Fix ui/ux
	$('#page-loading').hide();
	$('table td a span.glyphicon').parent().css('margin-right', '10px');
	$("form:not(.filter) .control-label:visible:first").click();
	$('#mainGridPjax')
		.on('pjax:start', function() {
			$('#page-loading').show();
		})
		.on('pjax:end',   function() {
			$('#page-loading').hide();
		});

	$(document).on("click", ".captcha-refresh-icon", function () {
		$(this).prev().click();
		$('#loginform-captcha').focus();
	})
	// Forcus vao input nhap captcha o login
	$('#loginform-captcha-image').click(function () {
		$('#loginform-captcha').focus();
		return true;
	});

	// End fix ui/ux

	$(document).on("click", "#reportCampaignExport", function () {
		var report_date = $('#reportcampaigndailysearch-report_date').val();
		var partner_id = $('#reportcampaigndailysearch-partner_id').val();
		var campaign_id = $('#reportcampaigndailysearch-campaign_id').val();
		var address = $('#reportcampaigndailysearch-address').val();

		var url = "/report-campaign-daily/export" + "?report_date=" + report_date
			+ "&partner_id=" + partner_id
			+ "&campaign_id=" + campaign_id
			+ "&address=" + address;
		window.location.href = url;
//		$.ajax({
//			type: "get",
//			url: "/report-campaign-daily/export",
//			data: {
//				report_date: $('#reportcampaigndailysearch-report_date').val(),
//				partner_id: $('#reportcampaigndailysearch-partner_id').val(),
//				campaign_id: $('#reportcampaigndailysearch-campaign_id').val(),
//				address: $('.reportcampaigndailysearch-address').val()
//			}, // do I need to pass data if im GET ting?
//			dataType: 'json',
//			success: function (data) {
//				//doing stuff
//				//end success
//			},
//			always: function () {
//				//submit form !!!
//				$("#formtopost").submit();
//			}
//		});//end ajax   

	});//end click


//    $(document).keypress(function (e) {
//        if (e.which == 13) {
//            return false;
//        }
//    });

	$('#btn-add-upload-video').click(function () {
		$('#list-avaliable option:selected').each(function () {
			$('#list-assigned').append($('<option>', {
				value: $(this).val(),
				text: $(this).text()
			}));
			$(this).remove();
		}
		);
	});

	$('#btn-remove-upload-video').click(function () {
		$('#list-assigned option:selected').each(function () {
			$('#list-avaliable').append($('<option>', {
				value: $(this).val(),
				text: $(this).text()
			}));
			$(this).remove();
		}
		);
	});

	$('#frm-btn-submit').click(function () {
		$("#list-assigned option").prop("selected", "selected");
		$("form:first").submit();
	});

	$('#frm-btn-song-submit').click(function () {
		$("#list-assigned option").prop("selected", "selected");
		if (!$('#editorTags').val()) {
			alert('Ca sỹ không được để trống');
			$('#editorTags').focus();
			return;
		}
		if (!$('#list-assigned').val()) {
			alert('Thể loại không được để trống');
			$('#list-assigned').focus();
			return;
		}
		$("form:first").submit();
	});

	$('#frm-btn-video-submit').click(function () {
		$("#list-assigned option").prop("selected", "selected");
		if (!$('#file-name-video').val()) {
			alert('Tên không được để trống');
			$('#file-name-video').focus();
			return;
		}
		if (!$('#editorTags').val()) {
			alert('Ca sỹ không được để trống');
			$('#editorTags').focus();
			return;
		}
		if (!$('#list-assigned').val()) {
			alert('Thể loại không được để trống');
			$('#list-assigned').focus();
			return;
		}
		$("form:first").submit();
	});

	$('#video-active-id').click(function () {
		var ids = '';
		$('input:checkbox:checked').each(function () {
			ids = ids + $(this).val() + ',';
		});
		if (ids != '') {
			if (confirm('Ban co chac muon kiem duyet?')) {
				$.ajax({
					method: "POST",
					url: "/video/active",
					data: {ids: ids}
				});
			}
		} else {
			alert('Ban chua chon ban ghi nao!');
		}
	});

	$('#song-active-id').click(function () {
		var ids = '';
		$('input:checkbox:checked').each(function () {
			ids = ids + $(this).val() + ',';
		});
		if (ids != '') {
			if (confirm('Ban co chac muon kiem duyet?')) {
				$.ajax({
					method: "POST",
					url: "/song/active",
					data: {ids: ids}
				});
			}
		} else {
			alert('Ban chua chon ban ghi nao!');
		}
	});

	$('#banneritem-target_type').change(function () {
		var itemId = $(this).val();
		if (itemId == 1) {
			$('#song-item-type').show();
			$('#video-item-type').hide();
			$('#playlist-item-type').hide();
		}
		if (itemId == 2) {
			$('#song-item-type').hide();
			$('#video-item-type').show();
			$('#playlist-item-type').hide();
		}
		if (itemId == 3) {
			$('#song-item-type').hide();
			$('#video-item-type').hide();
			$('#playlist-item-type').show();
		}
	});

	$('#banneritem-song_id').change(function () {
		$('#banneritem-target_id').val($(this).val());
	});

	$('#banneritem-video_id').change(function () {
		$('#banneritem-target_id').val($(this).val());
	});

	$('#banneritem-playlist_id').change(function () {
		$('#banneritem-target_id').val($(this).val());
	});


	$('.img_hover').hover(function() {
//        $(".img_hover").addClass('transition');
        $(this).addClass('transition');
    
        }, function() {
            $(".img_hover").removeClass('transition');
        });

});
