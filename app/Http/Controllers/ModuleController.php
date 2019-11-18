<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Http\Services\ModuleService;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    /**
     * @var ModuleService
     */
    protected $moduleService;

    /**
     * ModuleController constructor.
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getModules(Request $request)
    {
        return $this->moduleService->getModules($request->all());
    }

    /**
     * @param Module $module
     * @return Module
     */
    public function getOneModule(Module $module)
    {
        return $this->moduleService->getOneModule($module);
    }

    /**
     * @param ModuleRequest $request
     * @return Module
     * @throws Exception
     */
    public function storeModule(ModuleRequest $request)
    {
        DB::beginTransaction();
        try {
            $module = $this->moduleService->storeModule($request->all());
            DB::commit();
            return $module;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param ModuleRequest $request
     * @param Module $module
     * @return Module
     * @throws Exception
     */
    public function updateModule(ModuleRequest $request, Module $module)
    {
        DB::beginTransaction();
        try {
            $module = $this->moduleService->updateModule($module, $request->all());
            DB::commit();
            return $module;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function deleteManyModules(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->moduleService->deleteManyModules($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Module $module
     * @return string
     * @throws Exception
     */
    public function deleteOneModule(Module $module)
    {
        DB::beginTransaction();
        try {
            $status = $this->moduleService->deleteOneModule($module);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
