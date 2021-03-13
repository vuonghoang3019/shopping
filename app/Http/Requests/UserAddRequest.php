<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            'name' => 'required|unique:users|max:255|min:5',
            'email' => 'required|unique:users|max:191',
            'password' => 'required',
            'image' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'             => 'Tên không được để trống',
            'name.unique'               => 'Tên  không được trùng',
            'name.max'                  => 'Tên  không được quá 255',
            'email.required'             => 'email không được để trống',
            'email.unique'               => 'email  không được trùng',
            'email.max'                  => 'email  không được quá 191',
            'password.required'           => 'email  không được để trống',
            'image.required'                => 'Hãy chọn ảnh'
        ];
    }
}
