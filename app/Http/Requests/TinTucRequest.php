<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TinTucRequest extends Request
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
            'slt_theloai'=>'required',
            'slt_loaitin'=>'required',
            'txtTieuDe'=>'required|unique:tintucs,TieuDe',
            'txtTomTat'=>'required',
            'txtNoiDung'=>'required',
            'fImages'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'slt_theloai.required'=>'Tin Tức phải có Thể Loại',
            'slt_loaitin.required'=>'Tin Tức phải có Loại Tin',
            'txtTieuDe.required'=>'Tiêu đề không bỏ trống',
            'txtTieuDe.unique'=>'Tiêu đề đã tồn tại',
            'txtTomTat.required'=>'Tóm Tắt không bỏ trống',
            'txtNoiDung.required'=>'Nội dung không bỏ trống',
            'fImages.required'=>'Ảnh không bỏ trống'          
        ];
    }
}
