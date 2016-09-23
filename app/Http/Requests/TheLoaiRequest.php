<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TheLoaiRequest extends Request
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
            'txtTenTheLoai'=>'required|unique:theloais,Ten'
        ];
    }
    public function messages()
    {
        return [
            'txtTenTheLoai.required'=>'Tên Thể Loại Không Được Bỏ Trống',
            'txtTenTheLoai.unique'=>'Tên Thể Loại Đã Tồn Tại'
        ];
    }
}
