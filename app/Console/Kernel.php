<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\ServiceMakeCommand::class,
        \App\Console\Commands\FacadeMakeCommand::class,
        \App\Console\Commands\ServiceInterfaceMakeCommand::class,
        \App\Console\Commands\RepositoryMakeCommand::class,
        \App\Console\Commands\RepositoryInterfaceMakeCommand::class,
        \App\Console\Commands\ControllerServiceMakeCommand::class,
        \App\Console\Commands\BaseInterfaceMakeCommand::class,
        \App\Console\Commands\BaseServiceMakeCommand::class,
        \App\Console\Commands\BaseRepositoryMakeCommand::class,
        \App\Console\Commands\BaseRepositoryInterfaceMakeCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
