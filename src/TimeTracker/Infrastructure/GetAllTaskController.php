<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Src\TimeTracker\Application\GetAllTaskUseCase;

final class GetAllTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $getAllTaskUseCase      = new GetAllTaskUseCase($this->repository);
        $tasksList              = $getAllTaskUseCase->__invoke();

        return $tasksList;
    }
}
