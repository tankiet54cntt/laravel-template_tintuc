// sự kiện focus giá trị nếu xảy lỗi thì hiển thị ra lỗi luôn (ĐĂNG KÝ)
      $("#name_header_register").blur(function(){
           $(".error_register").remove();
           // đề phòng khi click thực hiện đăng ký tiếp ta muốn gỡ chữ đang ký thành công
           $("#edit_success").remove();
            // kiểm tra họ tên
            if($("#name_header_register").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_name_register").append("<span class='error_register'>Họ tên không được bỏ trống</span>");
            else
               if($("#name_header_register").val().length<3){
                $("#error_name_register").append("<span class='error_register'>Họ Tên ít nhất 3 ký tự nhé!</span>"); 
              }
      });
      $("#email_header_register").blur(function(){
           $(".error_register").remove();
           // đề phòng khi click thực hiện đăng ký tiếp ta muốn gỡ chữ đang ký thành công
           $("#edit_success").remove();
           var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
           var testmail=reg1.test($("#email_header_register").val());
            // kiểm tra email
            if($("#email_header_register").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_email_register").append("<span class='error_register'>Email không được bỏ trống</span>");
            else
            if(!testmail)
              $("#error_email_register").append("<span class='error_register'>Email không hợp lệ !</span>");
              
      });

      $("#password_header_register").blur(function(){
           $(".error_register").remove();
           // đề phòng khi click thực hiện đăng ký tiếp ta muốn gỡ chữ đang ký thành công
           $("#edit_success").remove();
            // kiểm tra họ tên
            if($("#password_header_register").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_password_register").append("<span class='error_register'>Password không được bỏ trống</span>");
            else
               if($("#password_header_register").val().length<5){
                $("#error_password_register").append("<span class='error_register'>Password ít nhất 5 ký tự nhé!</span>"); 
              }
                else
               if($("#passwordAgain_header_register").val() != $("#password_header_register").val()){
                $("#error_password_again_register").append("<span class='error_register'>Password xác nhận chưa chính xác!</span>"); 
              }
      });

      $("#passwordAgain_header_register").blur(function(){
           $(".error_register").remove();
           // đề phòng khi click thực hiện đăng ký tiếp ta muốn gỡ chữ đang ký thành công
           $("#edit_success").remove();
            // kiểm tra họ tên
            if($("#passwordAgain_header_register").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_password_again_register").append("<span class='error_register'>Password xác nhận không bỏ trống</span>");
            else
               if($("#passwordAgain_header_register").val() != $("#password_header_register").val()){
                $("#error_password_again_register").append("<span class='error_register'>Password xác nhận chưa chính xác!</span>"); 
              }
      });

//=================ĐĂNG NHẬP
$("#email_login").blur(function(){
      $(".error_login").remove();  // đề phòng lỗi nhiều lần (nó sẽ xóa cái trước và hiện chỉ 1 cái nếu ko có thì nó hiện bao nhiêu cái khi nào vẫn còn lỗi)
      // đề phòng lỗi tài khoản hoặc mật khẩu không đúng
      $("#login_error_header").remove();
      // thực hiện kiểm tra
      var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
      var testmail=reg1.test($("#email_login").val());
      // kiểm tra email
      if($("#email_login").val()=='')
        // hiển thị thông báo lỗi bằng jquery
          $("#error_email_login").append("<span class='error_login'>Email không được bỏ trống</span>");
      else
        if(!testmail)
         $("#error_email_login").append("<span class='error_login'>Email không hợp lệ !</span>");
});

$("#password_login").blur(function(){
           $(".error_login").remove();
           // đề phòng lỗi tài khoản hoặc mật khẩu không đúng
           $("#login_error_header").remove();
            // kiểm tra họ tên
            if($("#password_login").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_password_login").append("<span class='error_login'>Password không được bỏ trống</span>");
  });

//========================EDIT
$("#name_header_edit").blur(function(){
           $(".error_edit").remove();
           // đề phòng khi click thực hiện chỉnh sửa tiếp tiếp ta muốn gỡ chữ đang ký thành công
           $(".edit_success").remove();
            // kiểm tra họ tên
            if($("#name_header_edit").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_name_edit").append("<span class='error_edit'>Họ tên không được bỏ trống</span>");
            else
               if($("#name_header_edit").val().length<3){
                $("#error_name_edit").append("<span class='error_edit'>Họ Tên ít nhất 3 ký tự nhé!</span>"); 
              }
      });
$("#checkpassword").click(function(){
  
      // đề phòng khi click thực hiện chỉnh sửa tiếp tiếp ta muốn gỡ chữ đang ký thành công
      $(".edit_success").remove();
     if($("#checkpassword").val() != '')
     {
          $("#password_header_edit").blur(function(){
           $(".error_edit").remove();
            // kiểm tra họ tên
            if($("#password_header_edit").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_password_edit").append("<span class='error_edit'>Password không được bỏ trống</span>");
            else
               if($("#password_header_edit").val().length<5){
                $("#error_password_edit").append("<span class='error_edit'>Password ít nhất 5 ký tự nhé!</span>"); 
              }
                else
               if($("#passwordAgain_header_edit").val() != $("#password_header_edit").val()){
                $("#error_password_again_edit").append("<span class='error_edit'>Password xác nhận chưa chính xác!</span>"); 
              }
        });

        $("#passwordAgain_header_edit").blur(function(){
           $(".error_edit").remove();
          
            // kiểm tra họ tên
            if($("#passwordAgain_header_edit").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_password_again_edit").append("<span class='error_edit'>Password không được bỏ trống</span>");
            else
               if($("#passwordAgain_header_edit").val().length<5){
                $("#error_password_again_edit").append("<span class='error_edit'>Password ít nhất 5 ký tự nhé!</span>"); 
              }
                else
               if($("#passwordAgain_header_edit").val() != $("#password_header_edit").val()){
                $("#error_password_again_edit").append("<span class='error_edit'>Password xác nhận chưa chính xác!</span>"); 
              }
        });
     }
});


/***********==========================liên hệ==================******/
$("#name_contact").blur(function(){
           $(".error_contact").remove();
            // kiểm tra họ tên
            if($("#name_contact").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_name_contact").append("<span class='error_contact'>Họ tên không được bỏ trống</span>");
            else
               if($("#name_contact").val().length<3){
                $("#error_name_contact").append("<span class='error_contact'>Họ Tên ít nhất 3 ký tự nhé!</span>"); 
              }
      });
      $("#email_contact").blur(function(){
           $(".error_contact").remove();
           var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
           var testmail=reg1.test($("#email_contact").val());
            // kiểm tra email
            if($("#email_contact").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_email_contact").append("<span class='error_contact'>Email không được bỏ trống</span>");
            else
            if(!testmail)
              $("#error_email_contact").append("<span class='error_contact'>Email không hợp lệ !</span>");
              
      });

$("#noidung_lienhe").blur(function(){
  $(".noidung_lienhe").remove();
            if($("#noidung_lienhe").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_noidung_contact").append("<span class='error_contact'>Nội dung không được bỏ trống</span>");
});


//=====================SỰ KIỆN nút về đầu trang================================//

if($(".btn-top").length > 0){
    $(window).scroll(function () {
      var e = $(window).scrollTop();
      if (e > 300) {
        $(".btn-top").show()
      } else {
        $(".btn-top").hide()
      }
    });
    $(".btn-top").click(function () {
      $('body,html').animate({
        scrollTop: 0
      })
    })
  } 

//===========================SỰ KIỆN CLICK VÀO CHỦ ĐỀ , LOẠI TIN CHO CLASS ACTIVE=============================
