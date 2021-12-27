<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure\Repositories;

use App\Models\Task as ModelTask;
use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;
use Src\TimeTracker\Domain\ValueObjects\TaskName;
use Src\TimeTracker\Domain\ValueObjects\TaskStartTime;
use Src\TimeTracker\Domain\ValueObjects\TaskTotalTime;

final class EloquentTaskRepository implements TaskRepositoryContract
{
    private $eloquentTaskModel;

    public function __construct()
    {
        $this->eloquentTaskModel = new ModelTask();
    }

    public function find(TaskId $id): ?Task
    {
        $task = $this->eloquentTaskModel->findOrFail($id->value());

        // Return Domain Task model
        $taskEntity = new Task(
            new TaskId($task->id),
            new TaskName($task->name),
            new TaskStartTime($task->startTime),
            new TaskTotalTime($task->totalTime),
            new TaskIsOpen((bool)$task->isOpen)
        );

        return $taskEntity;
    }

    public function save(Task $task): void
    {
        $newTask = $this->eloquentTaskModel;

        $data = [
            'id'                => $task->id()->value(),
            'name'              => $task->name()->value(),
            'startTime'         => $task->startTime()->value(),
            'totalTime'         => $task->totalTime()->value(),
            'isOpen'            => $task->isOpen()->value(),
        ];

        $newTask->create($data);
    }

    public function update(TaskId $id, Task $task): void
    {
        $taskToUpdate = $this->eloquentTaskModel;

        $data = [
            'totalTime'     => $task->totalTime()->value(),
            'isOpen'        => $task->isOpen()->value()
        ];

        $taskToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }
}
