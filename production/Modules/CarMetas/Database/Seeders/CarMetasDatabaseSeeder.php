<?php

namespace Modules\CarMetas\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\EngineTypes\Entities\EngineType;

class CarMetasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //TestDummy::times(4)->create(EngineTypeModel::class);

    }
}
