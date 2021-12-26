<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('task', [
            'task' => [
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'startTime' => $request->get('startTime')
                ]
            ]
        );
    }
}
