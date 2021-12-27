<?php

declare(strict_types=1);

namespace Src\TimeTracker\Infrastructure;

use Illuminate\Http\Request;
use Src\TimeTracker\Application\CreateTaskUseCase;
use Src\TimeTracker\Infrastructure\Repositories\EloquentTaskRepository;
use Illuminate\Support\Str;
use Src\TimeTracker\Application\GetTaskByIdUseCase;

final class GetAllTaskController
{
    private $repository;

    public function __construct(EloquentTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $tasksList = [
            ['name' => 'homepage development', 'totalTime' => '360'],
            ['name' => 'test development', 'totalTime' => '720']
        ];

        return $tasksList;
    }
}
