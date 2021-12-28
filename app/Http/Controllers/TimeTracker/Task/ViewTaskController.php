<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\GetTaskByIdController;

class ViewTaskController extends Controller
{
    /** @var GetTaskByIdController */
    private $getTaskByIdController;

    public function __construct(GetTaskByIdController $getTaskByIdController)
    {
        $this->getTaskByIdController = $getTaskByIdController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        try {
            $task = (new TaskResource($this->getTaskByIdController->__invoke($id, $request)))->resolve();

            if ( !empty($task) ) {
                return view('task', compact('task'));
            }

            return redirect('/')->with('message', 'The requested task does not exist.');
        } catch (\Exception $e) {
            return redirect('/')->with('message', 'An error occurred, please try again later.');
        }
    }
}
