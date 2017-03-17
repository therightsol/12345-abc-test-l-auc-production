<?php

namespace Modules\Features\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\Features\Entities\Feature;


class FeaturesDatabaseSeeder extends Seeder
{

    public static $i = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = Feature::all();
        if (sizeof($size) === 0){
            Model::unguard();

            TestDummy::times(11)->create(Feature::class);
        }


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
