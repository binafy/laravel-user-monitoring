<?php

namespace Binafy\LaravelUserMonitoring\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveVisitMonitoringRecordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-user-monitoring:remove-visit-monitoring-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove visits-monitoring records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = config('user-monitoring.visit_monitoring.delete_days', 0);
        if ($days === 0) {
            $this->error('Your delete days are 0, You can go to the config file and change it!');
            return;
        }

        $date = now()->subDays($days)->toDateString();
        $table = config('user-monitoring.visit_monitoring.table');

        DB::table($table)
            ->where('created_at', '<', $date)
            ->delete();

        $this->info('Records have been removed successfully!');
    }
}
