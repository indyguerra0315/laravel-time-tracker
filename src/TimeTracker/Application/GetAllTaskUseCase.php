<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;

final class GetAllTaskUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?array
    {
        return $this->repository->getAll();
    }
}
