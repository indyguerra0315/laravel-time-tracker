<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Src\TimeTracker\Application\GetAllTaskUseCase;
use Src\TimeTracker\Application\GetOpenTaskUseCase;

final class GetOpenTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $getOpenTaskUseCase         = new GetOpenTaskUseCase($this->repository);
        $task                       = $getOpenTaskUseCase->__invoke();

        return $task;
    }
}
