<?php

namespace Modules\GeneralSettings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\GeneralSettings\Entities\GeneralSetting;

class GeneralSettingsDatabaseSeeder extends Seeder
{

    public static $i = 0;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = GeneralSetting::all();
        if (sizeof ($size) == 0){
            Model::unguard();
            TestDummy::times(5)->create(GeneralSetting::class);
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
