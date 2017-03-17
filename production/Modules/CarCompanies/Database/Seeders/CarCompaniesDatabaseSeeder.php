<?php

namespace Modules\CarCompanies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\CarCompanies\Entities\CarCompany;


class CarCompaniesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = CarCompany::all();

        if (sizeof($size) == 0){
            Model::unguard();
            TestDummy::times(2)->create(CarCompany::class);
        }
        // $this->call("OthersTableSeeder");
    }
}
