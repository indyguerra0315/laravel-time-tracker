<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;

final class CreateTaskController
{
    public function __invoke(Request $request)
    {
        $taskId                = $request->input('id');
        $taskName              = $request->input('name');
        $taskStartTime         = $request->input('startTime');

        return [
            'id' => $taskId,
            'name' => $taskName,
            'startTime' => $taskStartTime
        ];
    }
}
