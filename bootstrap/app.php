<?php

use App\Models\Task;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })->withSchedule(function (Schedule $schedule) {
        $tasks = Task::get();

        $tasks->each(function ($task) use ($schedule) {
            $params = explode(",", $task->params);
            if ($task->is_reccuring) {
                $schedule->call(fn() => report("Task {$task->id} is recurring"))
                    ->at($task->due_date)
                    ->name("task-{$task->id}-recurring");
            }

            $schedule->call(fn() => report("Task {$task->id} is not recurring"))
                ->{$task->frequency}(...$params)->name("task-{$task->id}-not-recurring");
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
