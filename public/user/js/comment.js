// KIỂM TRA KHI RỜI Ô INPUT
$("#name_comment").blur(function(){
	$(".error_comment").remove();
	if($("#name_comment").val()=='')
		$("#error_name_comment").append("<span class='error_comment'>Họ tên không được bỏ trống</span>");
	else
		if($("#name_comment").val().length<3)
			$("#error_name_comment").append("<span class='error_comment'>Họ tên không ít nhất 3 ký tự !</span>");

});
$("#email_comment").blur(function(){
	$(".error_comment").remove();
           // đề phòng khi click thực hiện đăng ký tiếp ta muốn gỡ chữ đang ký thành công
           var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
           var testmail=reg1.test($("#email_comment").val());
            // kiểm tra email
            if($("#email_comment").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_email_comment").append("<span class='error_comment'>Email không được bỏ trống</span>");
            else
            if(!testmail)
              $("#error_email_comment").append("<span class='error_comment'>Email không hợp lệ !</span>");

});
$("#noidung_comment").blur(function(){
	$(".error_comment").remove();
            if($("#noidung_comment").val()=='')
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_noidung_comment").append("<span class='error_comment'>Nội dung không được bỏ trống</span>");
});




function check_comment(hoten,email,noidung)
{
	var flash=1; 
	$(".error_comment").remove();
	// Check Họ Tên
	if(hoten==''){
		$("#error_name_comment").append("<span class='error_comment'>Họ tên không được bỏ trống</span>");
		flash=0;
	}
	else
		if(hoten.length<3){
			$("#error_name_comment").append("<span class='error_comment'>Họ tên không ít nhất 3 ký tự !</span>");
			flash=0;
		}
    // Check Email 
    var reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;  // dùng để kiểm tra email có đúng định dạng không
    var testmail=reg1.test(email);
    // kiểm tra email
    if(email==''){
        // hiển thị thông báo lỗi bằng jquery
        $("#error_email_comment").append("<span class='error_comment'>Email không được bỏ trống</span>");
    	flash=0;
    }
    else
        if(!testmail){
          $("#error_email_comment").append("<span class='error_comment'>Email không hợp lệ !</span>");
       		flash=0;
        }
     // Kiểm tra nội dung comment
     if(noidung==''){
                // hiển thị thông báo lỗi bằng jquery
                 $("#error_noidung_comment").append("<span class='error_comment'>Nội dung không được bỏ trống</span>");
     		flash=0;
     }
   if(flash==1)
    return true;
}


$("#guibinhluan").click(function(){

		
         var idTinTuc=$(this).attr('idTinTuc');
        // nếu như người dùng chưa đăng nhập
         var attr_hoten=$(this).attr("hoten");  // thuộc tính này ta kèm theo trong nút button để
         // lưu giá trị của hoten và email người đăng nhập vào
	 if(attr_hoten==undefined)
      {
        var hoten=$("#name_comment");
        var email=$("#email_comment");
        var noidung=$("#noidung_comment");
            if(check_comment(hoten.val(),email.val(),noidung.val())==true)  // nếu như check_comment đúng thì thực hiện ajax // nếu có lỗi thì tự hiện ra
    		{
    		   
    			// gửi lên ajax()
    			$.ajax({

    				url :"../../ajax/them-binh-luan/"+parseInt(idTinTuc),
    				type : "GET",
    				cache : false,
    				data :{"hoten":hoten.val(),"email":email.val(),"noidung":noidung.val(),"idTinTuc":parseInt(idTinTuc)},
    				success:function(ketqua_trave)
    				{
    					$(".ketqua").prepend(ketqua_trave);
    					hoten.val("");email.val("");noidung.val("");
    				}
    			});
    		}
      }
      else   //nếu như đã đăng nhập
      {
          $(".error_comment").remove();  // đề phòng người dùng click nút gửi bình luận nhiều lần
          // kiểm tra thử nội dung nhập vào chưa nếu như chưa thì thông báo lỗi
          if($("#noidung_comment").val()=='')
          {
            $("#error_noidung_comment").append("<span class='error_comment'>Nội dung không được bỏ trống</span>");       
            $("#noidung_comment").focus();
            return false;
          }
          else
          {
            var attr_email=$(this).attr("email");
            // gửi lên ajax()
                $.ajax({

                    url :"../../ajax/them-binh-luan/"+parseInt(idTinTuc),
                    type : "GET",
                    cache : false,
                    data :{"hoten":attr_hoten,"email":attr_email,"noidung":$("#noidung_comment").val(),"idTinTuc":parseInt(idTinTuc)},
                    success:function(ketqua_trave)
                    {
                        $(".ketqua").prepend(ketqua_trave);
                        $("#noidung_comment").val("");
                        
                    }
                });
          }
      }
});

/****************Juery AJAX XỬ LÝ KHI THỰC HIỆN CLICK XEM TRANG BÌNH LUẬN MỚI*****************/
// Tạo một function lấy biến trên trang web
function lay_gia_tri_page_tren_url(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
// Ý TƯỞNG THỰC HIỆN NÚT btn_nextpage này
/*
	- thứ nhất xác định biến page hiện tại thông qua hàm lay_gia_tri_page_tren_url(bien_can_lay_tren_url)
		nếu kết quả trả về false thì page mặc định là 1 ngược lại là số trang đang đứng

	- thứ hai do muốn hướng tới trang tiếp theo : ta thực hiện tăng biến trang đó lên 1 đơn vị
	và lư tổng số bình luận cần hiển thị trên 1 trang (thường thì giống với paginate)
	- lưu lai 2 giá trị trên url là : idTinTuc va TieuDeKhongDau
	- sau khi thực hiện xong đưa lên ajax và ajax thực hiện xong
	- kết thúc (success) : các việc phải làm
			+ lấy các giá trị thu được bỏ vào class ketqua 
			+ tự động thay link trang trước thành màu khác và trang hiện tại thành màu khác
				thông qua class
			+ tự động chuyển trang trên url thay page cho nó
*/
$("#btn_next_page").click(function(){
		$("#LoadingImage").show();
        // lấy ra id tin tức để biết được bình luận đó của tin tức nào
        var idTinTuc=$(this).attr('idTinTuc');
        var TieuDeKhongDau=$(this).attr('TieuDeKhongDau'); // lấy ra tiêu đề để lưu lại giá trị chuyển trang
		 // xác định trang hiện tại của ta đang đứng
		 var page =lay_gia_tri_page_tren_url("page");  // ví du http://localhost:8080/real-madrid-psg-tre-khong-cuu-duoc-gia.html?page=2;
		 // kết quả page=2
		 // Nếu ko có page thì mặc định nó là 1
		 if(page==false){page=1;}
		 var trangtruoc=page; // lưu lại giá trị trang hiện tại (thay bằng biến khác vì phía dưới page thay đổi)
		 // url hiện tại
        var urlCurrentPage="../../chitiettin/"+idTinTuc+"/"+TieuDeKhongDau+".html?page="+page;
		// số bình luận trên một trang
	    var comment_per_page = 10; // do trong controller t đã thực hiện paginate(10);
	    // trang hiện tại lúc này sẽ tăng lên 1 đơn vị
	    page++;
	    // url hướng tới
        var urlnextPage="../../chitiettin/"+idTinTuc+"/"+TieuDeKhongDau+".html?page="+page;
        
        // nếu như trang tiếp mà bằng tổng số trang thì ẩn nút next đi
	    if(page==$("#tongsotrang").val())
	     {
	     	$("#btn_next_page").hide();
	  		$("#btn_thugon").show();
	     }
        
        // thực hiện ajax khi click nút next
        $.ajax({

        		url:"../../ajax/next-binh-luan/"+idTinTuc,
        		type:'GET',
        		cache:false,
        		data:{"page":page,"comment_per_page":comment_per_page,"idTinTuc":parseInt(idTinTuc)},
        		success:function(ketqua_trave){
        				
        					$("#ds_binhluan").append(ketqua_trave);
        			//		$("#sotrang_comment"+page).addClass("active"); // thêm class vào trang hiện tại
        			//		$("#sotrang_comment"+trangtruoc).removeClass("active"); // gỡ class trang trước để cho nó mất màu đỏ
        					$("#LoadingImage").hide();
        					if (history.pushState) history.pushState(urlCurrentPage, "", urlnextPage); // chuyển urlCurrentPage thành urlnextPage mà không load lại trang
        				
        					return !history.pushState; // ngăn việc chuyển trang thực sự nếu trình duyệt có hỗ trợ pushState
        				
        		}
        });
});


$("#btn_thugon").click(function(){
		$("#ds_binhluan").remove();
		$("#LoadingImage").show();
         // lấy ra id tin tức để biết được bình luận đó của tin tức nào
        var idTinTuc=$(this).attr('idTinTuc');
        // lấy ra id tin tức để biết được bình luận đó của tin tức nào
        var idTinTuc=$(this).attr('idTinTuc');
        var TieuDeKhongDau=$(this).attr('TieuDeKhongDau'); // lấy ra tiêu đề để lưu lại giá trị chuyển trang
		// xác định trang hiện tại của ta đang đứng
		var page =lay_gia_tri_page_tren_url("page");  // ví du http://localhost:8080/real-madrid-psg-tre-khong-cuu-duoc-gia.html?page=2;
        var urlCurrentPage="../../chitiettin/"+idTinTuc+"/"+TieuDeKhongDau+".html?page="+page;
        if(page==false) page=1;
        $.ajax({

        		url:"../../ajax/thu-gon-binh-luan/"+parseInt(idTinTuc),
        		type: "GET",
        		cache: false,
        		data : {"idTinTuc":idTinTuc},
        		success : function(ketqua_respone){	
        				$(".ketqua").append(ketqua_respone);
        				$("#LoadingImage").hide();
        				$("#btn_next_page").show();
        				$("#btn_thugon").hide();
        				if (history.pushState) history.pushState(urlCurrentPage, "", "../../chitiettin/"+idTinTuc+"/"+TieuDeKhongDau+".html?page=1"); // chuyển urlCurrentPage thành urlnextPage mà không load lại trang
        		}
        });
});
