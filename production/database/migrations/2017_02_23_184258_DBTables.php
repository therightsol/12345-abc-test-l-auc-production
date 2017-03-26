<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Turn off Foreign Key checks.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Users and related - 6
        Schema::create('users', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->string('username', 255)->nullable();
            $table->enum('status', ['closed', 'open'])->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('cnic', 15)->nullable();
            $table->string('email', 191)->unique();
            $table->string('password', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('picture', 255)->nullable();
            $table->string('contact_number', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->enum('user_role', ['admin', 'staff', 'auctioneer', 'bidder'])->nullable();
            $table->bigInteger('updated_by', false, true)->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        echo "users table created \n";

        Schema::create('invoices', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->double('amount', 10,2)->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['paid', 'cancelled', 'pending', 'draft'])->nullable();
            $table->bigInteger('user_id', false, true)->unsigned()->nullable();
            $table->enum('payment_method', ['cash', 'cc', 'bank'])->nullable();
            $table->enum('payment_for', ['account', 'bid'])->nullable();
            $table->bigInteger('auction_id', false, true)->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('user_id','invoices.user_id_idx');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
        echo "invoices table created \n";

        Schema::create('inspection_requests', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('user_id', false, true)->unsigned()->nullable();
            $table->bigInteger('car_id', false, true)->unsigned()->nullable();
            $table->date('date_of_inspection')->nullable();
            $table->time('time_of_inspection')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('user_id','inspection_requests.uid_idx');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
        echo "inspection_requests table created \n";

        Schema::create('biddings', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('user_id', false, true)->unsigned()->nullable();
            $table->double('bid_amount', 10,2)->nullable();
            $table->bigInteger('auction_id', false, true)->unsigned()->nullable();;
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();


            $table->index('user_id','biddings.uid_idx');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');



        });
        echo "biddings table created \n";


        Schema::create('user_metas', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('user_id', false, true)->unsigned()->nullable();
            $table->longText('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();


            $table->index('user_id','uid_idx');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
        echo "user_metas table created \n";

        Schema::create('password_resets', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('email', 191)->index()->unique();
            $table->string('token', 191)->nullable();
            $table->dateTime('created_at')->nullable();

            $table->foreign('email')
                ->references('email')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
        echo "password_resets table created \n";




        // Cars and related - 10
        Schema::create('auctions', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->bigInteger('car_id', false, true)->unsigned()->nullable();
            $table->double('bid_starting_amount', 10,2)->nullable();
            $table->bigInteger('winner_user_id', false, true)->unsigned()->nullable();
            $table->double('average_bid', 10,2)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('car_id','auctions.car_id_idx');

            $table->foreign('car_id')
                ->references('id')->on('cars')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
        echo "auctions table created \n";


        Schema::create('car_metas', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('car_id', false, true)->unsigned()->nullable();
            $table->longText('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();


            $table->index('car_id','car_id_idx');

            $table->foreign('car_id')
                ->references('id')->on('cars')
                ->onDelete('no action')
                ->onUpdate('no action');


        });
        echo "car_metas table created \n";

        Schema::create('car_features', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id',9)->unsigned();
            $table->bigInteger('car_id', false, true)->unsigned()->nullable();
            $table->integer('feature_id', false, true)->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('car_id','car_features.car_id_idx');
            $table->index('feature_id','car_features.feature_id_idx');

            $table->foreign('feature_id')
                ->references('id')->on('features')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('car_id')
                ->references('id')->on('cars')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        echo "car_features table created \n";


        Schema::create('features', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id',9)->unsigned();
            $table->string('title', 255)->nullable();
            $table->string('icon_path', 255)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        echo "features table created \n";

        Schema::create('engine_types', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id',9)->unsigned();
            $table->string('title', 255)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        echo "engine_types table created \n";


        Schema::create('car_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('car_id',false, true)->unsigned()->nullable();
            $table->bigInteger('category_id',false, true)->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('car_id','car_categories.car_id_idx');
            $table->index('category_id','car_categories.category_id_idx');

            $table->foreign('car_id')
                ->references('id')->on('cars')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
        echo "car_categories table created \n";


        Schema::create('car_models', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id',9)->unsigned();
            $table->integer('car_company_id',false, true)->unsigned()->nullable();
            $table->string('model_name',255)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('car_company_id','car_company_id_idx');

            $table->foreign('car_company_id')
                ->references('id')->on('car_companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
        echo "car_models table created \n";


        Schema::create('cars', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->bigInteger('user_id',false, true)->nullable()->unsigned();
            $table->string('title',255)->nullable();
            $table->double('average_price',10,2)->nullable();
            $table->double('minimum_price',10,2)->nullable();
            $table->integer('manufacturing_year', false, true)->nullable();
            $table->integer('car_model_id', false, true)->nullable()->unsigned();
            $table->integer('engine_type_id', false, true)->nullable()->unsigned();
            $table->string('trim', 255)->nullable();
            $table->string('exterior_color', 7)->nullable();
            $table->string('interior_color', 7)->nullable();
            $table->enum('grade', ['A', 'B', 'C', 'D'])->nullable();
            $table->integer('kilometers', false, true)->nullable()->unsigned();
            $table->string('engine_number', 255)->nullable();
            $table->string('chassis_number', 255)->nullable();
            $table->string('number_plate', 255)->nullable();
            $table->string('city_of_registration', 255)->nullable();
            $table->enum('transmission', ['automatic', 'manual'])->nullable();
            $table->string('body_type', 255)->nullable();
            $table->string('drivetrain', 255)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();


            $table->index('engine_type_id','cars.engine_type_idx');
            $table->index('car_model_id','cars.model_idx');
            $table->index('user_id','cars.uid_idx');

            $table->foreign('engine_type_id')
                ->references('id')->on('engine_types')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('car_model_id')
                ->references('id')->on('car_models')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('set null');


        });
        echo "cars table created \n";

        Schema::create('car_companies', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id',9)->unsigned();
            $table->string('company_name',255)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        Schema::create('categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->string('category',255)->nullable();
            $table->bigInteger('category_parent_id',false, true)->nullable()->unsigned();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        echo "car_companies table created \n";


        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('posts', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('title', 255)->nullable();
            $table->string('short_description', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 191)->nullable();
            $table->string('featured_image', 255)->nullable();
            $table->longText('images')->nullable();
            $table->string('post_type', 50)->nullable()->default('post');
            $table->string('mime_type', 255)->nullable();
            $table->integer('post_status_id')->unsigned()->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->unique('slug','slug_UNIQUE');


            $table->index('user_id','user_id_idx');
            $table->index('post_status_id','post_status_idx');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('post_status_id')
                ->references('id')->on('post_statuses')
                ->onDelete('no action')
                ->onUpdate('no action');


        });
        echo "posts table created \n";



        Schema::create('post_statuses', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('status_title', 100)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();


        });
        echo "post_statuses table created \n";




        // General Tables - 2
        Schema::create('notifications', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->tinyInteger('is_read')->nullable();
            $table->bigInteger('user_id', false, true)->unsigned()->nullable();
            $table->string('short_msg',100)->nullable();
            $table->longText('long_msg')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
        echo "notifications table created \n";

        Schema::create('general_settings', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id',20)->unsigned();
            $table->string('key', 191)->nullable()->unique();
            $table->longText('value')->nullable();
            $table->tinyInteger('is_default')->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('key', 'key_x');

        });
        echo "general_settings table created \n";



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Users and related - 6
        Schema::drop('users');
        Schema::drop('invoices');
        Schema::drop('inspection_requests');
        Schema::drop('biddings');
        Schema::drop('user_metas');
        Schema::drop('password_resets');


        // Cars and related - 10
        Schema::drop('auctions');
        Schema::drop('car_metas');
        Schema::drop('car_features');
        Schema::drop('features');
        Schema::drop('engine_types');
        Schema::drop('car_categories');
        Schema::drop('car_models');
        Schema::drop('cars');
        Schema::drop('car_companies');
        Schema::drop('categories');


        Schema::drop('posts');
        Schema::drop('post_statuses');

        // General Tables - 2
        Schema::drop('notifications');
        Schema::drop('general_settings');

    }
}
