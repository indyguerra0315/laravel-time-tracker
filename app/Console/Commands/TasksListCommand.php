<?php

namespace App\Console\Commands;

use App\Http\Resources\TaskSummaryCollection;
use App\Http\Resources\TaskSummaryResource;
use Illuminate\Console\Command;
use Src\TimeTracker\Infrastructure\GetAllTaskController;

class TasksListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $getAllTaskController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GetAllTaskController $getAllTaskController)
    {
        parent::__construct();

        $this->getAllTaskController = $getAllTaskController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasksList = (new TaskSummaryCollection($this->getAllTaskController->__invoke()))->resolve();

        $this->table(
            ['Name', 'Time'],
            $tasksList
        );

        return 0;
    }
}
