<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'date'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];
    }

    public function messages() 
    {
        return [
            'name.required'=>'Tên bắt buộc nhập',
            'name.min'=>'Tên từ 6 ký tự trở lên',
            'name.max'=>'Tên tối đa 32 ký tự',
            'date.required'=>'Ngày sinh bắt buộc nhập',
            'password.required'=>'Bắt buộc nhập password',
        ];
    }
}
