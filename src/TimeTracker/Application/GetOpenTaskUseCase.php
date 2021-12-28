<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;
use Src\TimeTracker\Domain\Task;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;

final class GetOpenTaskUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?Task
    {
        $isOpen  = new TaskIsOpen(true);

        $task = $this->repository->findByCriteria($isOpen);

        return $task;
    }
}
