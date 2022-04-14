<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:6|max:32',
            'description'=>'min:6',
            'price'=>'required',
            'image_url'=>'required',
            'status'=>'required',
            'category_id'=>'required',
        ];
    }

    public function messages() 
    {
        return [
            'name.required'=>'Tên bắt buộc nhập',
            'name.min'=>'Tên từ 6 ký tự trở lên',
            'name.max'=>'Tên tối đa 32 ký tự',
            'description.min'=>'Mô tả tối thiểu 6 ký tự',
            'price.required'=>'Giá sản phẩm bắt buộc nhập',
            'image_url.required'=>'Bắt buộc chọn ảnh',
            'status.required'=>'Trạng thái là bắt buộc chọn',
            'category_id.required'=>'Bắt buộc điền ID',
        ];
    }
}
