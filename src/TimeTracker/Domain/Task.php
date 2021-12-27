<?php

declare(strict_types=1);

namespace Src\TimeTracker\Domain;

use Src\TimeTracker\Domain\ValueObjects\TaskEndTime;
use Src\TimeTracker\Domain\ValueObjects\TaskId;
use Src\TimeTracker\Domain\ValueObjects\TaskIsOpen;
use Src\TimeTracker\Domain\ValueObjects\TaskName;
use Src\TimeTracker\Domain\ValueObjects\TaskStartTime;
use Src\TimeTracker\Domain\ValueObjects\TaskTotalTime;

final class Task
{
    private $id;
    private $name;
    private $startTime;
    private $totalTime;
    private $isOpen;

    public function __construct(
        TaskId $id,
        TaskName $name,
        TaskStartTime $startTime,
        TaskIsOpen $isOpen,
        TaskTotalTime $totalTime = null,
        TaskEndTime $endTime = null
    )
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->startTime    = $startTime;
        $this->endTime      = $endTime;
        $this->totalTime    = $totalTime;
        $this->isOpen       = $isOpen;
    }

    public function id(): TaskId
    {
        return $this->id;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function startTime(): TaskStartTime
    {
        return $this->startTime;
    }

    public function endTime(): TaskEndTime
    {
        return $this->endTime;
    }

    public function totalTime(): TaskTotalTime
    {
        return $this->totalTime;
    }

    public function isOpen(): TaskIsOpen
    {
        return $this->isOpen;
    }

    public static function create(
        TaskId $id,
        TaskName $name,
        TaskStartTime $startTime,
        TaskIsOpen $isOpen,
        TaskTotalTime $totalTime = null,
        TaskEndTime $endTime = null
    ): Task
    {
        $task = new self($id, $name, $startTime, $isOpen, $totalTime, $endTime);

        return $task;
    }
}
