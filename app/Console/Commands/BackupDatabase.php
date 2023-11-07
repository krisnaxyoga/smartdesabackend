<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    protected $process;

    public function __construct()
    {
        parent::__construct();

        $this->process = new Process(sprintf(
            'mysqldump -u%s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            storage_path('backups/backup.sql')
        ));
    }

    public function handle()
    {
        try {
            $this->process->mustRun();

            $disk = Storage::disk('s3');
            $date = date('Ymd_His');
            $file = $disk->putFileAs(
                'backups', // Path.
                new File(storage_path('backups/backup.sql')), // File.
                "database_{$date}.sql", // Name.
                ['visibility' => 'public'] // Visibility.
            );

            $this->info('The backup has been proceed successfully. File path: ' . $file);
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed. Reason: ' . $exception->getMessage());
        }
    }
}
