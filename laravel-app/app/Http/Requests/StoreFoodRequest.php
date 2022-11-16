<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>"required|max:255",
            "count"=>"required|integer|min:0|max:1000",
            "category_id"=>"required"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên sản phẩm',
            'count.required' => 'Nhập số lượng cho sản phẩm',
            'category_id.required' => 'Chọn loại cho sản phẩm',
        ];
    }
}
