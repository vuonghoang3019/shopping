<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:sliders|max:255|min:5',
            'image_path' => 'required',
            'description' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'             => 'Tên không được để trống',
            'name.unique'               => 'Tên sản phẩm không được trùng',
            'name.max'                  => 'Tên sản phẩm không được quá 255',
            'name.min'                  => 'Tên sản phẩm không được ít hơn 10 ký tự',
            'image_path.required'       => 'Ảnh đại diện ko được để trống',
            'description.required'      => 'Mô tả không được để trống',
        ];
    }
}
