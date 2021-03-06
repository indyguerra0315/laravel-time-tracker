<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;
use Src\TimeTracker\Application\CreateTaskUseCase;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Illuminate\Support\Str;
use Src\TimeTracker\Application\GetTaskByIdUseCase;

final class CreateTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $data)
    {
        $taskId                = $data['id'];
        $taskName              = $data['name'];
        $taskStartTime         = $data['startTime'];

        $createTaskUseCase = new CreateTaskUseCase($this->repository);
        $createTaskUseCase->__invoke(
            $taskId,
            $taskName,
            $taskStartTime
        );

        $getTaskByIdUseCase     = new GetTaskByIdUseCase($this->repository);
        $newTask                = $getTaskByIdUseCase->__invoke($taskId);

        return $newTask;
    }
}
