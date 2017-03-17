<?php

namespace Modules\EngineTypes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\EngineTypes\Entities\EngineType;

class EngineTypesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = EngineType::all();
        if (sizeof($size) === 0){
            Model::unguard();

            TestDummy::times(4)->create(EngineType::class);
        }



        // $this->call("OthersTableSeeder");
    }
}
