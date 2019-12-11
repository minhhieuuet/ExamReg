<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRoomRequest extends FormRequest
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
            'room_id' => 'required',
            'exam_session_id' => 'required'
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
            'name.required' => 'Tên phòng là bắt buộc',
            'room_id.required' => 'Bạn phải chọn phòng máy',
            'exam_session_id.required' => 'Bạn phải chọn ca thi',
        ];
    }
}
