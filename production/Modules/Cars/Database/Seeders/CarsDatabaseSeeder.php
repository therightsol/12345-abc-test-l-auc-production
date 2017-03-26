<?php

namespace Modules\Cars\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\Cars\Entities\CarCategories;
use Modules\Cars\Entities\CarFeature;
use Modules\Cars\Entities\Car;
use Modules\Cars\Entities\Category;

class CarsDatabaseSeeder extends Seeder
{
    public static $i = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $cat_size = Category::all();

        if (sizeof($cat_size) == 0){
            TestDummy::times(5)->create(Category::class);
        }

        TestDummy::times(100)->create(Car::class);
        TestDummy::times(200)->create(CarCategories::class);
        TestDummy::times(100)->create(CarFeature::class);


        // $this->call("OthersTableSeeder");
    }

    public static function getIterationNumber()
    {
        $i = self::$i ++;
        return $i;
    }

    public static function updateIterationNumber( $number ){
        self::$i = $number;
    }
}
