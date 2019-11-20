<?php

namespace App\Http\Services;

use App\Models\ExamSession;
use Exception;

class ExamSessionService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getExamSessions($params)
    {
        $limit = array_get($params, 'limit', 10);

        return ExamSession::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param ExamSession $examSession
     * @return ExamSession
     */
    public function getOneExamSession(ExamSession $examSession)
    {
        return $examSession;
    }

    /**
     * @param $params
     * @return ExamSession
     */
    public function storeExamSession($params)
    {
        $examSession = ExamSession::create([
            'name' => array_get($params, 'name'),
            'capacity' => array_get($params, 'capacity'),
        ]);

        return $this->getOneExamSession($examSession);
    }

    /**
     * @param ExamSession $examSession
     * @param $params
     * @return ExamSession
     */
    public function updateExamSession(ExamSession $examSession, $params)
    {
        $examSession->update([
          'name' => array_get($params, 'name'),
          'capacity' => array_get($params, 'capacity'),
        ]);

        return $examSession;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyExamSessions($params)
    {
        $examSessionIds = array_get($params, 'ids', []);

        if (count($examSessionIds) > 0) {
            ExamSession::whereIn('id', $examSessionIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param ExamSession $examSession
     * @return string
     * @throws Exception
     */
    public function deleteOneExamSession(ExamSession $examSession)
    {
        $examSession->delete();

        return 'ok';
    }
}
