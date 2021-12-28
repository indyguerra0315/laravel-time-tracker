<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Src\TimeTracker\Application\GetTaskByIdUseCase;

final class GetTaskByIdController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id, Request $request)
    {
        $taskId       = $id;

        $getTaskByIdUseCase     = new GetTaskByIdUseCase($this->repository);
        $newTask                = $getTaskByIdUseCase->__invoke($taskId);

        return $newTask;
    }
}
