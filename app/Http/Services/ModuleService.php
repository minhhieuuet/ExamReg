<?php

namespace App\Http\Services;

use App\Models\Module;
use Exception;

class ModuleService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getModules($params)
    {
        $limit = array_get($params, 'limit', 10);

        return Module::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%")->orWhere('code', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param Module $module
     * @return Module
     */
    public function getOneModule(Module $module)
    {
        return $module;
    }

    /**
     * @param $params
     * @return Module
     */
    public function storeModule($params)
    {
        $module = Module::create([
            'name' => array_get($params, 'name'),
            'code' => array_get($params, 'code'),
        ]);

        return $this->getOneModule($module);
    }

    /**
     * @param Module $module
     * @param $params
     * @return Module
     */
    public function updateModule(Module $module, $params)
    {
        $module->update([
            'name' => array_get($params, 'name'),
            'code' => array_get($params, 'code'),
        ]);

        return $module;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyModules($params)
    {
        $moduleIds = array_get($params, 'ids', []);

        if (count($moduleIds) > 0) {
            Module::whereIn('id', $moduleIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param Module $module
     * @return string
     * @throws Exception
     */
    public function deleteOneModule(Module $module)
    {
        $module->delete();

        return 'ok';
    }
}
