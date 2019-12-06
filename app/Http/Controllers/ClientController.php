<?php

namespace App\Http\Controllers;

use Exception;
use App\User;
use App\Models\Module;
use App\Models\ExamSession;
use Illuminate\Http\Request;
use App\Http\Services\ClientService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{

    protected $clientService;

    /**
     * ModuleController constructor.
     *
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAllModules()
    {
        return $this->clientService->getAllModules();
    }

    public function getAllModuleExamSessions(Module $module) {
        return $this->clientService->getAllModuleExamSessions($module);
    }

    public function getAllRegistedSessions() {
      return $this->clientService->getAllRegistedSessions();
    }

    public function totalExamSessionComputers(ExamSession $examSession) {
      return $this->clientService->totalExamSessionComputers($examSession);
    }

    public function registerSession(Request $requests) {
      return $this->clientService->registerSession($requests->all());
    }

}
