<?php

namespace Modules\InspectionRequests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\InspectionRequests\Entities\InspectionRequest;

class InspectionRequestsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TestDummy::times(100)->create(InspectionRequest::class);


        // $this->call("OthersTableSeeder");
    }
}
