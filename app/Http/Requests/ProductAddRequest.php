<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name'          => 'required|unique:products|max:255|min:5',
            'price'         => 'required',
            'category_id'   => 'required',
            'feature_image' => 'required',
            'contents'      => 'required',
            'quantity'      => 'required|max:100|min:1'
        ];

    }

    public function messages()
    {
        return [
            'name.required'          => 'Tên không được để trống',
            'name.unique'            => 'Tên sản phẩm không được trùng',
            'name.max'               => 'Tên sản phẩm không được quá 255',
            'name.min'               => 'Tên sản phẩm không được ít hơn 5 ký tự',
            'price.required'         => 'Giá không được để trống',
            'category_id.required'   => 'Danh mục ko được để trống',
            'feature_image.required' => 'Ảnh đại diện ko được để trống',
            'contents.required'      => 'Mô tả không được để trống',
            'quantity.required'      => 'Số lượng không được để trống',
            'quantity.max'           => 'Số lượng không được quá 1000 sản phẩm',
            'quantity.min'           => 'Số lượng không dưới sản phẩm',
        ];
    }
}
