<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'code' => 'required|between:1,16',
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
            'name.required' => 'Tên học phần là bắt buộc',
            'code.required' => 'Mã học phần là bắt buộc',
            'code.between' => 'Mã học phần phải nằm trong khoảng 1-16',
        ];
    }
}
