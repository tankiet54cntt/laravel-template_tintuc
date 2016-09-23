<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=User::Orderby('id','DESC')->get();
        return View('admin.user.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return View('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=new User;
        $user->name=$request->txtName;
        $user->email=$request->txtEmail;
        $user->password=Hash::make($request->txtPass); // mã hóa mật khẩu
        $user->quyen=$request->rdoLevel;
        $user->remember_token=$request->_token;
        $user->save();
        // chuyển trang
        return redirect()->route('admin.user.index')->with(['flash_level'=>'success','flash_message'=>'Success complete add User']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_edit= User::find($id);
        return View('admin.user.edit',compact('user_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);

        if($request->input('txtPass')){
            $this->validate($request,
                [
                    'txtRePass'=>'same:txtPass'
                ],
                [
                    'txtRePass.same'=>'Two Password don\'t Match'
                ]);
            $pass=$request->input('txtPass');
            $user->password=Hash::make($pass);
        }
        $user->name=$request->input('txtName');
        $user->quyen=$request->input('rdoLevel');
        $user->remember_token=$request->input('_token');
        $user->save();
        // chuyển trang
        return redirect()->route('admin.user.index')->with(['flash_level'=>'success','flash_message'=>'Success complete Update User']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // lấy id user hiện tại
      //  $user_current_login=Auth::user()->id; // khi nào đăng nhập kiểm tra
        $user=User::find($id); // tìm kiếm user với id 
        if($user->quyen==1){
            // chuyển trang
        return redirect()->route('admin.user.index')->with(['flash_level'=>'danger','flash_message'=>'You Can\'t delete User']);
        }
        else
        {
            $user->delete($id);
            // chuyển trang
        return redirect()->route('admin.user.index')->with(['flash_level'=>'success','flash_message'=>'Success complete delete User']);
        }
    }
    //==============================XỬ LÝ ĐĂNG NHẬP PHÍA ADMIN======================
     public function getDangNhap(){
        return View('admin.login');
    }
    public function postDangNhap(Request $request){

            $this->validate($request,
                [
                    'email'=>'required|email',
                    'password'=>'required|min:5'
                ],
                [
                    'email.required'=>'Chưa Nhập Email',
                    'email.email'=>'Email chưa đúng định dạng',
                    'password.required'=>'Chưa Nhập Mật Khẩu',
                    'password.min'=>'Mật Khẩu ít nhất 6 kí tự'
                ]);

            $admin_login=[
                'email'=>$request->email,
                'password'=>$request->password,
                // 'quyen'=>1 // quyền =1 là admin
                // người dùng là member cũng đăng nhập được khi ko quy định quyền (nhưng ta đã kiểm tra lỗi ở middle ware rồi ko sao)
            ];

            if(Auth::attempt($admin_login))  // nếu như thông tin đăng nhập thành công
            {
                return redirect('admin');
            }
            else
            {
                return redirect()->back()->with(['flash_message'=>'Tài Khoản Hoặc Mật Khẩu Chưa đúng']);
            }
    }

    public function getDangXuat(){
        Auth::logout();
        return redirect()->route('dangnhapadmin');
    }
}
