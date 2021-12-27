<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;
use Src\TimeTracker\Domain\ValueObjects\TaskName;
use Src\TimeTracker\Domain\ValueObjects\TaskStartTime;
use Src\TimeTracker\Domain\ValueObjects\TaskTotalTime;

final class CreateTaskUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $name,
        string $startTime
    ): void
    {
        $id         = new TaskId($id);
        $name       = new TaskName($name);
        $startTime  = new TaskStartTime($startTime);
        $totalTime  = new TaskTotalTime(0);
        $isOpen     = new TaskIsOpen(true);

        $task = Task::create($id, $name, $startTime, $totalTime, $isOpen);

        $this->repository->save($task);
    }
}
