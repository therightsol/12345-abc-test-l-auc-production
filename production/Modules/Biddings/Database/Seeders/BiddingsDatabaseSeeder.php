<?php

namespace Modules\Biddings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Biddings\Entities\Bidding;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class BiddingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TestDummy::times(50)->create(Bidding::class);


        // $this->call("OthersTableSeeder");
    }
}
