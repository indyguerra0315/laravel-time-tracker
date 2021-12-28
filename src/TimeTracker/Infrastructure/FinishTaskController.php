<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Src\TimeTracker\Application\FinishTaskUseCase;
use Src\TimeTracker\Application\GetTaskByIdUseCase;

final class FinishTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id, Request $request)
    {
        $taskId       = $id;
        $taskEndTime  = $request->input('endTime');

        $finishTaskUseCase = new FinishTaskUseCase($this->repository);
        $finishTaskUseCase->__invoke(
            $taskId,
            $taskEndTime
        );
    }
}
