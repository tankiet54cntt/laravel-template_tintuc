<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SlideRequest extends Request
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
            'txtTen'=>'required|unique:slides,Ten',
            'fImages'=>'required',
            'txtNoiDung'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'txtTen.required'=>'Tên Slide Không Được Bỏ Trống',
            'txtTen.unique'=>'Tên Slide Đã Tồn Tại',
            'fImages.required'=>'Ảnh slide Không Được Bỏ Trống',
            'txtNoiDung.required'=>'Nội dung Không Được Bỏ Trống'
        ];
    }
}
