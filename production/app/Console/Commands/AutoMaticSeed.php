<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Schema;

class AutoMaticSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automaticseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically migrate and seed.';

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
        //
        //$this->call('make:controller', ['name' => 'abc']);

        // 1) getting database
        $database_name = getenv('DB_DATABASE');
        if (! $database_name || empty( $database_name ) ){
            $this->error('Database name not resolved.');
            $database_name = $this->ask("Please enter database name ");
        }


        // 2) Dropping tables (If already available)
        $tables = DB::select('SHOW TABLES');
        if (sizeof($tables) > 0){
            $this->error("Database is already migrated.");
            $this->info("Trying to re-migrate. Please wait ... ");

            $this->info("\nStep 1: Dropping Tables...\n");
            do{
                $confirm = $this->ask("Are you sure to delete all tables ? [yes / no]");
                if (strtolower($confirm) === 'yes') break;
            }while(strtolower($confirm) !== 'no');

            if ( strtolower($confirm) == 'no' ){
                $this->error('Terminating by user');
                return;
            }

            $dbTable = 'Tables_in_' . $database_name;

            $tables = DB::select('SHOW TABLES');
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            foreach($tables as $table)
            {
                Schema::drop($table->$dbTable);
                echo 'Table ' . $table->$dbTable . " has been dropped\n";
            }
        }

        // 2) Migrating
        $this->info("\nStep 2: Migration Started...\n");
        $this->call('migrate');
        $this->info("\nMigration has been completed.");


        // 3) Seeding
        $this->info("\nStep 3: Seeding Started...\n");
        $this->call('module:seed', ['module' => 'Users'] );
        $this->call('module:seed', ['module' => 'Notifications'] );
        $this->call('module:seed', ['module' => 'Media'] );
        $this->call('module:seed', ['module' => 'GeneralSettings'] );
        $this->call('module:seed', ['module' => 'Features'] );
        $this->call('module:seed', ['module' => 'EngineTypes'] );
        $this->call('module:seed', ['module' => 'CarCompanies'] );
        $this->call('module:seed', ['module' => 'CarModels'] );
        $this->call('module:seed', ['module' => 'Cars'] );
        $this->call('module:seed', ['module' => 'InspectionRequests'] );
        $this->call('module:seed', ['module' => 'Auctions'] );
        $this->call('module:seed', ['module' => 'Biddings'] );
        $this->call('module:seed', ['module' => 'Invoices'] );
    }
}
