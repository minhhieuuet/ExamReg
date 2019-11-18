<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityRequest extends FormRequest
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
            'name' => 'required',
            'short_name' => 'required|between:1,4',
        ];
    }

    /**
     * Get the messages if validate fail.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên trường là bắt buộc',
            'short_name.required' => 'Tên viết tắt của trường là bắt buộc',
            'short_name.between' => 'Tên viết tắt của trường phải nằm trong khoảng 1-4',
        ];
    }
}
