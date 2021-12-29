# Time Tracker
### Author: Ing. Indira Guerra Rodriguez

## Build
- Run `cp .env.example .env` to create app environment file.
- Run `./vendor/bin/sail up -d` to up the docker containers.
- Run `./vendor/bin/sail bash` to access the console.
- Run `composer install` command to install php dependencies.
- Run `php artisan migrate` to generate tables.
- Run `npm install`.
- Run `npm run prod` to compilate js and css resources.

## Running unit tests

Run `php artisan test` from sail bash or `./vendor/bin/sail test` to execute the unit tests via [PHPUnit](https://phpunit.de/).

# The task is to make a simple time tracker. The user should be able to:
- Type the name of the task he is working on and click “start”.
- See the timer that is counting how long the task is already taking.
- Click Stop to stop working on that task (the timer stops).
- Type another name for a diﬀerent task and click “start” again. The page should start
counting from the beginning.
- On the same page (or other, up to you) user should be able to see the summary of the
time tracker where it displays

### Requirements:
- The tasks can be recognized by name, so if I type “homepage development” twice
during one day, spend 2h in the morning and 0.5h in the afternoon, then at the end of
the day I should see 2.5h near “homepage development”.

### One step further:
Write a PHP script that:
- Receives by parameter the action (start / end) and the name of the task.
- And other that have to returns a list of all the tasks with their status, start time, end time and total elapsed
time.

# SOLUTION

## For the solution:
- I implemented the solution with the Laravel framework on Docker managed with Sail.
- Hexagonal architecture concepts as well as DDD were applied.
- Design patterns and SOLID principles were applied.
- Integration tests were performed: `CreateTaskTest`, `FinishTaskTest`, `GitAllTaskTest`.
## Main Folders structure

Framework folder structure:
- `app/Console/Commands`: Definition of the application commands that can be executed on the console.
- `app/Http/Controllers/TimeTracker/Task`: Framework controllers.
- `app/Http/Resources`: Files for transformation between models and responses to application users.
- `app/Models`: Framework models.

In addition, we are going to find the following folder structure based on the hexagonal architecture:
- `src/Shared`: Files that will be common for all bounded context.
- `src/TimeTracker`: Files that handle all of the business logic of the TimeTracker bounded context `html`, `css`, `js` and `views`.

```
app
├── Console
│       └── Commands
│
├── Http
│   ├── Controllers
│   │   └── TimeTracker
│   │       └── Task
│   │
│   └── Resources
│
├── Models
│
src
├── Shared
│   └── Domain
│       ├── Aggregate
│       └── ValueObjects
│
├── TimeTracker
│   ├── Aplication
|   │
│   ├── Domain
│   │   ├── Contracts
│   │   └── ValueObjects
│   │
│   └── Infrastructure
│       └── Repositories
resources
├── css
├── js
└── views
```

### TODO list
- Implement more unit and integration tests and improve the ones that were implemented.
- Improve user interface.
