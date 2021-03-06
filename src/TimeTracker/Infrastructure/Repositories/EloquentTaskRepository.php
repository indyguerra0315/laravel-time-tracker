<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure\Repositories;

use App\Models\Task as ModelTask;
use DateTime;
use Illuminate\Support\Facades\DB;
use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\TaskSummary;
use Src\TimeTracker\Domain\ValueObjects\TaskEndTime;
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

        $endTime = null;
        if (!empty($task->endTime)) {
            $endTime = new TaskEndTime($task->endTime);
        }

        // Return Domain Task model
        $taskEntity = new Task(
            new TaskId($task->id),
            new TaskName($task->name),
            new TaskStartTime($task->startTime),
            new TaskIsOpen((bool)$task->isOpen),
            new TaskTotalTime($task->totalTime),
            $endTime,
        );

        return $taskEntity;
    }

    public function findByCriteria(string $column, $valueObject): ?Task
    {
        $task = $this->eloquentTaskModel
            ->where($column, $valueObject->value())
            ->firstOrFail();

        $endTime = null;
        if (!empty($task->endTime)) {
            $endTime = new TaskEndTime($task->endTime);
        }

        // Return Domain Task model
        return new Task(
            new TaskId($task->id),
            new TaskName($task->name),
            new TaskStartTime($task->startTime),
            new TaskIsOpen((bool)$task->isOpen),
            new TaskTotalTime($task->totalTime),
            $endTime,
        );
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
            'name'      => $task->name()->value(),
            'startTime' => $task->startTime()->value(),
            'endTime'   => $task->endTime()->value(),
            'totalTime' => $task->totalTime()->value(),
            'isOpen'    => $task->isOpen()->value()
        ];

        $taskToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function getAll(): array
    {
        $query = $this->eloquentTaskModel::query()
            ->groupBy('name')
            ->select('name', DB::raw("SUM(totalTime) as totalTime"))
            ->get();

        $tasksList = $query->map(function ($task) {
            return new TaskSummary(
                new TaskName($task->name),
                new TaskTotalTime((int)$task->totalTime)
            );
        });

        return $tasksList->toArray();
    }

    public function totalTimeByDay(DateTime $day): int
    {
        $date = $day->format('Y-m-d');

        $res = $this->eloquentTaskModel
            ->where(DB::raw('DATE(startTime)'), DB::raw("DATE('$date')"))
            ->where('isOpen', 0)
            ->select(DB::raw('SUM(totalTime) as totalTime'))
            ->first();

        return (int) $res->totalTime;
    }
}
