<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetAllTaskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tasksList = [
            ['name' => 'homepage development', 'totalTime' => '360'],
            ['name' => 'test development', 'totalTime' => '720']
        ];

        return view('tasks-list', compact('tasksList'));
    }
}
