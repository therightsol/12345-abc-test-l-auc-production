<?php

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\Media\Entities\Post;
use Modules\Media\Entities\PostStatus;

class MediaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $size = PostStatus::all();

        if ( sizeof($size) == 0){
            TestDummy::times(4)->create(PostStatus::class);
        }


        // $this->call("OthersTableSeeder");
    }
}
