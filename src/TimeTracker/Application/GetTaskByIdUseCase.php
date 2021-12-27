<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;

final class GetTaskByIdUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?Task
    {
        $id  = new TaskId($id);

        $task = $this->repository->find($id);

        return $task;
    }
}
