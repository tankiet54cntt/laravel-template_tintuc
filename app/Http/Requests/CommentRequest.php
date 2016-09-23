<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentRequest extends Request
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
            'txtHoTen'=>'required',
            'txtEmail'=>'required|email',
            'txtNoiDung'=>'required',
            'sltTinTuc'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'txtHoTen.required'=>'Họ Tên Không Bỏ Trống',
            'txtEmail.required'=>'Email không bỏ trống',
            'txtEmail.email'=>'Chưa đúng định dạng email',
            'txtNoiDung.required'=>'Chưa Nhập nội dung bình luận',
            'sltTinTuc.required'=>'Chưa chọn loại tin tức muốn bình luận'
        ];
    }
}
