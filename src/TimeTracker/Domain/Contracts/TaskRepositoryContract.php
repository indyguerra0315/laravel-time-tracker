<?php

declare(strict_types=1);

namespace Src\TimeTracker\Domain\Contracts;

use DateTime;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;

interface TaskRepositoryContract
{
    public function find(TaskId $id): ?Task;

    public function findByCriteria(string $column, $valueObject): ?Task;

    public function save(Task $task): void;

    public function update(TaskId $userId, Task $task): void;

    public function getAll(): array;

    public function totalTimeByDay(DateTime $day): int;
}
