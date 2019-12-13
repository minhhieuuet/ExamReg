<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestSiteRequest extends FormRequest
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
            'exam_id' => 'required',
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
            'name.required' => 'Tên điểm thi là bắt buộc',
            'exam_id.required' => 'Bạn phải chọn kì thi',
        ];
    }
}
