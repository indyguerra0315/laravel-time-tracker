<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use DateTime;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Src\TimeTracker\Application\GetTasksTimeByDayUseCase;

final class GetTasksTimeByDayController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DateTime $day)
    {
        $getTasksTimeByDayUseCase       = new GetTasksTimeByDayUseCase($this->repository);
        $task                           = $getTasksTimeByDayUseCase->__invoke($day);

        return $task;
    }
}
