<?php

namespace App\Http\Services;

use App\Models\University;
use Exception;

class UniversityService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getUniversities($params)
    {
        $limit = array_get($params, 'limit', 10);

        return University::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%")->orWhere('short_name', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param University $university
     * @return University
     */
    public function getOneUniversity(University $university)
    {
        return $university;
    }

    /**
     * @param $params
     * @return University
     */
    public function storeUniversity($params)
    {
        $university = University::create([
            'name' => array_get($params, 'name'),
            'short_name' => array_get($params, 'short_name'),
        ]);

        return $this->getOneUniversity($university);
    }

    /**
     * @param University $university
     * @param $params
     * @return University
     */
    public function updateUniversity(University $university, $params)
    {
        $university->update([
            'name' => array_get($params, 'name'),
            'short_name' => array_get($params, 'short_name'),
        ]);

        return $university;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyUniversities($params)
    {
        $universityIds = array_get($params, 'ids', []);

        if (count($universityIds) > 0) {
            University::whereIn('id', $universityIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param University $university
     * @return string
     * @throws Exception
     */
    public function deleteOneUniversity(University $university)
    {
        $university->delete();

        return 'ok';
    }
}
