<?php

namespace Modules\Invoices\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Modules\Invoices\Entities\Invoice;

class InvoicesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TestDummy::times(100)->create(Invoice::class);


        // $this->call("OthersTableSeeder");
    }
}
