<?php

declare(strict_types=1);

namespace Src\TimeTracker\Application;

use DateTime;
use Src\TimeTracker\Domain\Contracts\TaskRepositoryContract;

final class GetTasksTimeByDayUseCase
{
    private $repository;

    public function __construct(TaskRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DateTime $day): ?int
    {
        return $this->repository->totalTimeByDay($day);
    }
}
