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
        string $endTime,
        string $id = null,
        string $name = null,
    ): void
    {
        // Prepare data
        $endTime    = new TaskEndTime($endTime);

        if (!empty($id)) {
            $id         = new TaskId($id);

            // Get Current task stored data
            $oldTask = $this->repository->find($id);

            $this->stopTask($oldTask, $endTime);
        }

        if(!empty($name)) {
            $name       = new TaskName($name);

            // Get Current task stored data
            $oldTask = $this->repository->findByCriteria('name', $name);

            $this->stopTask($oldTask, $endTime);
        }
    }

    private function stopTask(Task $oldTask, TaskEndTime $endTime)
    {
        if ($oldTask->isOpen()->value()) {
            $isOpen     = new TaskIsOpen(false);

            // Calculate time spent on task
            $diff = $endTime->diff($oldTask->startTime());
            $totalTime = new TaskTotalTime($diff);

            // Create task with updated data
            $updatedTask = Task::create(
                $oldTask->id(),
                $oldTask->name(),
                $oldTask->startTime(),
                $isOpen,
                $totalTime,
                $endTime
            );

            // Persist data
            $this->repository->update($oldTask->id(), $updatedTask);
        }
    }
}
