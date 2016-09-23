$('#btn_dangky').click(function(){
        /* slide theo chiều ngang */
           //  $('#jason_register').toggle(true);  // true : ta ko thấy hiểu ứng
          //  $('#jason_register').toggle(2000);
        /* slide theo chiều ngang */     
              gan_login();
              gan_register();
        // Nếu như click vào nút đăng ký form đăng nhập có thì ẩn nó đi và mở form đăng ký
        if($('#jason').toggle(true))
        {
            $('#jason').toggle(false);
             /* Slide theo chiều dọc */
            $('#jason_register').slideToggle();
            /* Slide theo chiều dọc */
        }
});
$('#btn_dangnhap').click(function(){
        /* slide theo chiều ngang */
           //  $('#jason_register').toggle(true);  // true : ta ko thấy hiểu ứng
          //  $('#jason_register').toggle(2000);
        /* slide theo chiều ngang */     
        // gán các giá trị trong form là rỗng
              gan_login();
              gan_register();
        // Nếu như click vào nút đăng ký form đăng nhập có thì ẩn nó đi và mở form đăng ký
        if($('#jason_register').toggle(true))
        {
            $('#jason_register').toggle(false);
            
             /* Slide theo chiều dọc */
            $('#jason').slideToggle();
            /* Slide theo chiều dọc */
        }
});

$('#thoat_login').click(function(){
       $(".loginbox").slideToggle(false);
       gan_login();
});
$('#thoat_register').click(function(){
       $(".registerbox").slideToggle(false);
       gan_register();
});
$('#thoat_edit').click(function(){
       $(".edit_userbox").slideToggle(false);
       gan_edit();
});
$('#btn_chinhsua').click(function(){
    $('#jason_edit_user').slideToggle();
    gan_edit();
});
// khi click vào nút bạn có tài khoản
$('#co_tai_khoan').click(function(){
        gan_register();
        $('#jason_register').toggle(false);  //ẩn đi
        $('#jason').slideToggle();
});
// khi click vào hay đăn ký (hiện quên mật khẩu đấy chưa sửa)
$('#hay_dang_ky').click(function(){
        gan_login();
        $('#jason').toggle(false);
        // hiện đăng ký lên
        $('#jason_register').slideToggle();
    });


function gan_register()
{
            $("#email_header_register").val("");
            $("#password_header_register").val("");
            $("#passwordAgain_header_register").val("");
            $("#email_header_register").val("");
            $("#name_header_register").val("");
            $(".error_register").remove();
            $("#edit_success").remove();
}
function gan_login()
{
    $("#email_login").val("");
    $("#password_login").val("");
    $(".error_login").remove();
    $("#login_error_header").remove();
}

function gan_edit()
{
   $(".error_edit").remove();
   $(".edit_success").remove();
   $("#passwordAgain_header_edit").val("");
   $("#password_header_edit").val("");
}