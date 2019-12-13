<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'register_started_at' => 'required',
            'register_finished_at' => 'required',
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
            'name.required' => 'Tên kì thi là bắt buộc',
            'register_started_at.required' => 'Thời gian bắt đầu đăng kí là bắt buộc',
            'register_finished_at.required' => 'Thời gian kết thúc đăng kí là bắt buộc',
        ];
    }
}
