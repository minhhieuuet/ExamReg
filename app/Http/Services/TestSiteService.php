<?php

namespace App\Http\Services;

use App\Models\TestSite;
use App\Models\Exam;
use Exception;

class TestSiteService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getTestSites($params)
    {
        $limit = array_get($params, 'limit', 10);

        return TestSite::join('exams', 'test_sites.exam_id', 'exams.id')
        ->select('test_sites.*', 'exams.name as exam_name')->when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%")->orWhere('capacity', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param TestSite $testSite
     * @return TestSite
     */
    public function getOneTestSite(TestSite $testSite)
    {
        return $testSite;
    }

    /**
     * @param $params
     * @return TestSite
     */
    public function storeTestSite($params)
    {
        $testSite = TestSite::create([
            'name' => array_get($params, 'name'),
            'exam_id' => array_get($params, 'exam_id'),
        ]);

        return $this->getOneTestSite($testSite);
    }

    /**
     * @param TestSite $testSite
     * @param $params
     * @return TestSite
     */
    public function updateTestSite(TestSite $testSite, $params)
    {
        $testSite->update([
          'name' => array_get($params, 'name'),
          'exam_id' => array_get($params, 'exam_id'),
        ]);

        return $testSite;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyTestSites($params)
    {
        $testSiteIds = array_get($params, 'ids', []);

        if (count($testSiteIds) > 0) {
            TestSite::whereIn('id', $testSiteIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param TestSite $testSite
     * @return string
     * @throws Exception
     */
    public function deleteOneTestSite(TestSite $testSite)
    {
        $testSite->delete();

        return 'ok';
    }

    public function getAllExams() {
      return Exam::all();
    }
}
