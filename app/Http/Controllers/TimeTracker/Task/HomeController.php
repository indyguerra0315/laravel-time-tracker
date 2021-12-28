<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\GetOpenTaskController;

class HomeController extends Controller
{
    /** @var GetOpenTaskController */
    private $getOpenTaskController;

    public function __construct(GetOpenTaskController $getOpenTaskController)
    {
        $this->getOpenTaskController = $getOpenTaskController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        try {
            $openTask = $this->getOpenTaskController->__invoke();

            if ( !empty($openTask) ) {
                $task = (new TaskResource($openTask))->resolve();
                return redirect('/tasks/'. $task['id']);
            }

            return view('home');
        } catch (\Exception $e) {
            return view('home');
        }
    }
}
