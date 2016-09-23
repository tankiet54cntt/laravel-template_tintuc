<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoaiTinRequest extends Request
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
            'sltParent'=>'required',
            'txtTenLoaiTin'=>'required|unique:loaitins,Ten'
        ];
    }
    public function messages()
    {
        return [
            'sltParent.required'=>'Tên Loại Tin phải có Thể Loại',
            'txtTenLoaiTin.required'=>'Tên Loại Tin Không Được Bỏ Trống',
            'txtTenLoaiTin.unique'=>'Tên Loại Tin Đã Tồn Tại'
        ];
    }
}
