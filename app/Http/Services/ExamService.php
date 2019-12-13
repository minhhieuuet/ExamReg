<?php

namespace App\Http\Services;

use App\Models\Exam;
use Exception;

class ExamService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getExams($params)
    {
        $limit = array_get($params, 'limit', 10);

        return Exam::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param Exam $exam
     * @return Exam
     */
    public function getOneExam(Exam $exam)
    {
        return $exam;
    }

    /**
     * @param $params
     * @return Exam
     */
    public function storeExam($params)
    {
        $exam = Exam::create([
            'name' => array_get($params, 'name'),
            'register_started_at' => array_get($params, 'register_started_at'),
            'register_finished_at' => array_get($params, 'register_finished_at'),
        ]);

        return $this->getOneExam($exam);
    }

    /**
     * @param Exam $exam
     * @param $params
     * @return Exam
     */
    public function updateExam(Exam $exam, $params)
    {
        $exam->update([
            'name' => array_get($params, 'name'),
            'register_started_at' => array_get($params, 'register_started_at'),
            'register_finished_at' => array_get($params, 'register_finished_at'),
        ]);

        return $exam;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyExams($params)
    {
        $examIds = array_get($params, 'ids', []);

        if (count($examIds) > 0) {
            Exam::whereIn('id', $examIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param Exam $exam
     * @return string
     * @throws Exception
     */
    public function deleteOneExam(Exam $exam)
    {
        $exam->delete();

        return 'ok';
    }
}
