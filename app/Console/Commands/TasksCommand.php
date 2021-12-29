<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Src\TimeTracker\Infrastructure\CreateTaskController;
use Src\TimeTracker\Infrastructure\FinishTaskController;

class TasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task {action} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or end Task by name.';

    protected $createTaskController;

    protected $finishTaskController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CreateTaskController $createTaskController, FinishTaskController $finishTaskController)
    {
        parent::__construct();

        $this->createTaskController = $createTaskController;
        $this->finishTaskController = $finishTaskController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('action') === 'start') {
            $data = [
                'id' => \Str::uuid()->toString(),
                'name' => $this->argument('name'),
                'startTime' => (new DateTime())->format('Y-m-d H:i:s')
            ];

            $this->createTaskController->__invoke($data);
        }


        if ($this->argument('action') === 'end') {
            $data = [
                'name' => $this->argument('name'),
                'endTime' => (new DateTime())->format('Y-m-d H:i:s')
            ];

            $this->finishTaskController->__invoke($data);
        }

        return 0;
    }
}
