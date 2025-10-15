<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CheckDbName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-db-name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the actual database name being used by the CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Membersihkan cache konfigurasi secara paksa
        $this->call('config:clear');
        $this->info("Cache konfigurasi dibersihkan...");

        // Memuat ulang konfigurasi dari file
        Config::set('database.connections.mysql.database', env('DB_DATABASE'));

        // Mendapatkan nama database yang sedang aktif
        $dbName = DB::connection()->getDatabaseName();

        $this->info("======================================================");
        $this->info("Laravel terhubung ke database: " . $dbName);
        $this->info("======================================================");

        return 0;
    }
}