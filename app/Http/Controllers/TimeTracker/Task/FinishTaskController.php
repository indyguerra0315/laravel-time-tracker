<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinishTaskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        return redirect('/tasks-list');
    }
}
