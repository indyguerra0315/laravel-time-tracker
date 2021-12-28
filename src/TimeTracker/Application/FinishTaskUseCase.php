<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskEndTime;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;
use Src\TimeTracker\Domain\ValueObjects\TaskName;
use Src\TimeTracker\Domain\ValueObjects\TaskStartTime;
use Src\TimeTracker\Domain\ValueObjects\TaskTotalTime;

final class FinishTaskUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $endTime
    ): void
    {
        // Prepare data
        $id         = new TaskId($id);
        $endTime    = new TaskEndTime($endTime);
        $isOpen     = new TaskIsOpen(false);

        // Get Current task stored data
        $oldTask = $this->repository->find($id);

        // Calculate time spent on task
        $diff = $endTime->diff($oldTask->startTime());
        $totalTime = new TaskTotalTime($diff);

        // Create task with updated data
        $updatedTask = Task::create(
            $id,
            $oldTask->name(),
            $oldTask->startTime(),
            $isOpen,
            $totalTime,
            $endTime
        );

        // Persist data
        $this->repository->update($id, $updatedTask);
    }
}
