<?php

namespace App\Http\Services;

use App\Models\Module;
use Exception;
use App\User;
use DB;
use App\Models\ModuleUser;
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
        })->select('modules.*')
        ->addSelect(DB::raw(
                    "COALESCE((select count(*)
                    from module_user
                    where  modules.id = module_user.module_id), 0) as total_user"
                ))
        ->orderBy('created_at', 'desc')->paginate($limit);
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

    public function getAllStudentsInModule($module) {
      return ModuleUser::leftJoin('users', 'module_user.user_id', 'users.id')
              ->where(['role' => 1, 'module_id' => $module->id])->get();
    }

    public function removeOneStudentFromModule($request) {
      $status = ModuleUser::where(['user_id' => $request->student_id, 'module_id' => $request->module_id])->delete();
      return $status;
    }

    public function toggleStudentModuleStatus($request) {
      $moduleUser = ModuleUser::where(['user_id' => $request->student_id, 'module_id' => $request->module_id])->first();
      $moduleUser->update(['status' => !$moduleUser->status]);
      return $moduleUser;
    }
    public function getAllStudentsToAdd($module) {
      return User::where('role', 1)->get();
    }

    public function addStudentsToModule($request) {
      $studentIds = array_get($request, 'ids');
      $moduleId = array_get($request, 'module_id');
      foreach($studentIds as $id) {
        ModuleUser::firstOrCreate(['user_id' => $id, 'module_id' => $moduleId], [
          'user_id' => $id,
          'module_id' => $moduleId,
          'status' => 1,
          'exam_id' => 5
        ]);
      }
      return 'ok';
    }
}
