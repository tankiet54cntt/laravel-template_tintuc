<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtName'=>'required',
            'txtEmail'=>'required|email|unique:users,email',
            'txtPass'=>'required',
            'txtRePass'=>'required|same:txtPass',
            
        ];
    }
    public function messages()
    {
        return [
            'txtName.required'=>'Username không thể bỏ trống',
            'txtPass.required'=>'Password không thể bỏ trống',
            'txtRePass.required'=>'Xác nhận Password không thể bỏ trống',
            'txtRePass.same'=>'Mật khẩu xác nhận chưa đúng',
            'txtEmail.required'=>'Email không thể bỏ trống',
            'txtEmail.email'=>'Chưa đúng định dạng email',
            'txtEmail.unique'=>'email đã tồn tại'
        ];
    }
}
