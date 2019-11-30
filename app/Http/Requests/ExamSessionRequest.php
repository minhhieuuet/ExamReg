<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSessionRequest extends FormRequest
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
          'test_site_id' => 'required',
          'module_id' => 'required',
          'started_at' => 'required_with:finishedAt|required',
          'finished_at' => 'required_with:startedAt|gt:started_at'
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
            'test_site_id.required' => 'Địa điểm thi là bắt buộc',
            'module_id.required' => 'Học phần là bắt buộc',
            'started_at.required' => 'Thời điểm băt đầu là bắt buộc',
            'finished_at.required' => 'Thời điểm kết thúc là bắt buộc',
            'finished_at.gt' => 'Thời điểm bắt đầu phải trươc thời điểm kết thúc'
        ];
    }
}
