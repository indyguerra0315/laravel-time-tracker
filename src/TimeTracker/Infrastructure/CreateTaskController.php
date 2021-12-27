<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;
use Src\TimeTracker\Application\CreateTaskUseCase;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Illuminate\Support\Str;
use Src\TimeTracker\Domain\ValueObjects\TaskId;

final class CreateTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $taskId                = Str::uuid()->toString();
        $taskName              = $request->input('name');
        $taskStartTime         = $request->input('startTime');

        $createUserUseCase = new CreateTaskUseCase($this->repository);
        $createUserUseCase->__invoke(
            $taskId,
            $taskName,
            $taskStartTime
        );

        $task = $this->repository->find(new TaskId($taskId));

        // $getUserByCriteriaUseCase = new GetTaskByCriteriaUseCase($this->repository);
        // $newUser                  = $getUserByCriteriaUseCase->__invoke($userName, $userEmail);

        return $task;
    }
}
