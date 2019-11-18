<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'capacity' => 'required|numeric|between:1,100',
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
            'name.required' => 'Tên phòng máy là bắt buộc',
            'capacity.required' => 'Số lượng máy là bắt buộc',
            'capacity.numeric' => 'Số lượng máy phải là số',
            'capacity.between' => 'Số lượng máy phải nằm trong khoảng 1-100',
        ];
    }
}
