<?php

namespace App\Console;

use App\Models\Lawatan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Report;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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
        

        $schedule->call(function () {

            $date = date("Y-m-d");
            Lawatan::where([
                ['tarikh_lawatan', '<=', $date],
                ['status_lawatan', '=', "3"],
            ])
            ->get()
            ->map(function ($lawatan) {
                $lawatan->status_lawatan = str_replace($lawatan->status_lawatan, '', '4');
                $lawatan->save();
                return $lawatan;
            });

            Report::truncate();

        })->daily();
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
