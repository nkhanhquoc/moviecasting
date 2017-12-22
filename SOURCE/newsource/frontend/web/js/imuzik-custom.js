var isNavigation = false;

function submitLogin() {
  var username = $.trim($('#login-username').val());
  var password = $.trim($('#login-username').val());
  if(!username || !password){
    $('#error-message').html('Bạn phải nhập tên và mật khẩu');
    return false;
  }
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $.post(
    '/index.php/user/login',
    {
      username: username,
      password: $.base64Encode(password),
      _csrf: csrfToken,
    },
    function(data){
      if(data == 0){
        window.location.href = window.location.href;
      } else {
        $('#error-message').html(data);
        return false;
      }
    }
  );
}
