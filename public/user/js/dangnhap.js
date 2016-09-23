$("#submit_login_2").click(function(){
    var email = $("#email");
    var password= $("#password");
      if(check(email,password)) /*Nếu đã check đúng thì thực hiện tiếp*/
      {
         $.ajax({

              url : base_url + "ajax/dang-nhap",
              type : "GET",
              cache : false,
              data : {"email":email.val(),"password":password.val()},
              success : function(ketqua)
              {
                 if(ketqua=="error")
                 {
                    // Xóa loi đi đề phòng nhập 2 lần sai
                    $('.loi').remove();
                    $("#loi_dangnhap").append("<span class='loi'>Tài Khoản hoặc mật khẩu không đúng !</span>");
                    email.val("");
                    password.val("");
                    
                  }
                 else
                 {
                    if(ketqua=="yes")
                      window.location.reload();
                 }
              }
         });
      }
});

function check(email,password)
{
  
     $(".error_right_slidebar").remove(); 
     var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
     var testmail=reg1.test(email.val());
     var flash=1;  // gắn cờ để biết có xảy ra lỗi không (mặc định 1 là 0 có lỗi)
  // kiểm tra mail và định dạng mail
      if($("#email").val()=='')
        {
          // hiển thị thông báo lỗi bằng jquery
            $("#error_login_email").append("<span class='error_right_slidebar'>Email không được bỏ trống</span>");
            flash=0; // có lỗi
        }
      else
      if(!testmail){
            $("#error_login_email").append("<span class='error_right_slidebar'>Email không hợp lệ !</span>");
            flash =0 ; // có lỗi
        }
      if($("#password").val()==''){
            // hiển thị thông báo lỗi bằng jquery
            $("#error_login_password").append("<span class='error_right_slidebar'>Password không được bỏ trống</span>");
            flash =0 ;// có lõi
        }
    if(flash==1)  // nếu không có lỗi trả về true
      return true;
}

// sự kiện focus giá trị nếu xảy lỗi thì hiển thị ra lỗi luôn (ĐĂNG Nhập) bên right sliderbar
  $("#email").blur(function(){
           $(".error_right_slidebar").remove();
           // làm mất đi dòng tài khoản hoặc mật khẩu không đúng khi nhập email
           $(".loi").remove();
           var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
           var testmail=reg1.test($("#email").val());
            // kiểm tra email
            if($("#email").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_login_email").append("<span class='error_right_slidebar'>Email không được bỏ trống</span>");
            else
            if(!testmail)
              $("#error_login_email").append("<span class='error_right_slidebar'>Email không hợp lệ !</span>");
              
    });

  $("#password").blur(function(){
           $(".error_right_slidebar").remove();
           // làm mất đi dòng tài khoản hoặc mật khẩu không đúng khi nhập pass
           $(".loi").remove();
           var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
           var testmail=reg1.test($("#email").val());
            // kiểm tra họ tên
            if($("#password").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_login_password").append("<span class='error_right_slidebar'>Password không được bỏ trống</span>");
              
    });

