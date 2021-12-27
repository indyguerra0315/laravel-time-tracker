<?php

declare(strict_types=1);

namespace Src\TimeTracker\Domain\Contracts;

use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;

interface TaskRepositoryContract
{
    public function find(TaskId $id): ?Task;

    public function save(Task $task): void;

    public function update(TaskId $userId, Task $task): void;

    public function getAll(): array;
}
