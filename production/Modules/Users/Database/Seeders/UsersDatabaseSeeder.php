<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\UserModel;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TestDummy::times(100)->create(UserModel::class);
        // $this->call("OthersTableSeeder");
    }
}
