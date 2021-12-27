<?php

declare(strict_types = 1);

namespace Src\TimeTracker\Domain;

use Src\Shared\Domain\Aggregate\AggregateRoot;
use Src\TimeTracker\Domain\ValueObjects\TaskName;
use Src\TimeTracker\Domain\ValueObjects\TaskTotalTime;

final class TaskSummary extends AggregateRoot
{
    private $name;
    private $totalTime;

    public function __construct(
        TaskName $name,
        TaskTotalTime $totalTime
    )
    {
        $this->name      = $name;
        $this->totalTime = $totalTime;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function totalTime(): TaskTotalTime
    {
        return $this->totalTime;
    }

    public static function create(
        TaskName $name,
        TaskTotalTime $totalTime
    ): TaskSummary
    {
        $taskSummary = new self($name, $totalTime);

        return $taskSummary;
    }
}
