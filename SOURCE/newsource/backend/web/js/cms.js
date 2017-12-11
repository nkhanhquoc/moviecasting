/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * TrungTH 18/07 - customize thông báo required
 */

/*
 $(document).ready(function () {
 var input = document.getElementById("msisdn");
 input.addEventListener('invalid', function(e) {
 if(input.validity.patternMismatch) {
 e.target.setCustomValidity("Bạn phải nhập số điện thoại Viettel!");
 } else {
 e.target.setCustomValidity('a');
 }
 // to avoid the 'sticky' invlaid problem when resuming typing after getting a custom invalid message
 input.addEventListener('input', function(e){
 e.target.setCustomValidity(' ');
 });
 }, false);
 });


 */
/*
 $(document).ready(function(){
 $("form").submit(function(){
 var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
 if($.trim($("#msisdn").val()) === "") {
 alert('Bạn phải nhập số điện thoại!');
 return false;
 } else if (input.validity.valueMissing) {
 alert('ko nnhap');
 return false;
 } else {
 return true;
 }
 });
 });*/

$(document).ready(function () {
    $('#video_upload_1').on('change', function (event) {
        var file = this.files[0];
        var type = file.type;
        var videoNode = document.querySelector('#video1');
        var canPlay = videoNode.canPlayType(type);
        if (canPlay === '')
            canPlay = 'no';
        var isError = canPlay === 'no';
        alert(isError);
        if (isError) {
            return;
        }
        videoNode.src = createObjectURL(file);
        videoNode.controls = true;
    });
});

