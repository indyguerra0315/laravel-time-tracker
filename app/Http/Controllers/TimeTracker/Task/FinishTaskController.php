<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\FinishTaskController as InfrastructureFinishTaskController;

class FinishTaskController extends Controller
{
    /** @var InfrastructureFinishTaskController */
    private $infrastructureFinishTaskController;

    public function __construct(InfrastructureFinishTaskController $infrastructureFinishTaskController)
    {
        $this->infrastructureFinishTaskController = $infrastructureFinishTaskController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $data = $request->only(['endTime']);
        $data['id'] = $id;

        $this->infrastructureFinishTaskController->__invoke($data);

        return redirect('/tasks-list');
    }
}
