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

    public function __invoke($data)
    {
        $taskId       = !empty($data['id']) ? $data['id'] : null;
        $taskName     = !empty($data['name']) ? $data['name'] : null;
        $taskEndTime  = $data['endTime'];

        $finishTaskUseCase = new FinishTaskUseCase($this->repository);
        $finishTaskUseCase->__invoke(
            $taskEndTime,
            $taskId,
            $taskName
        );
    }
}
