<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backups database automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d_hms') . ".backup";
        $path = Storage::disk('backupfiles')->path('/');
        $filepath = str_replace("\\", "", $path);

        $command = "pg_dump -h ".env('DB_HOST')." -p " . env('DB_PORT') ." -d " . env('DB_DATABASE') ." -U ". env('DB_USERNAME')." -W -E UTF8 -F c --file=".$filepath.$filename;
        // ." -w " . env('DB_PASSWORD') . -E UTF8 -F c
        //for password (to be mended)
        
        $returnVar = NULL;
        $output  = NULL;
  
        exec($command, $output, $returnVar);

        $this->info('Database Backup taken successfully');
        //check larave.log file to confirm all the queries has run successfully
        \Log::info("Database Backup taken successfully at:". date("F j, Y, g:i a"));
    }
}

