<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'full_name' => 'required',
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Tên đăng nhập đã tồn tại',
            'email.unique'  => 'Email đã tồn tại',
        ];
    }
}
