<?php
/**
 * Created by PhpStorm.
 * User: abcd
 * Date: 12/16/2016
 * Time: 12:08 PM
 */

$factory(\Modules\Users\Entities\UserModel::class, function ($faker) {

    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $password = 'secret';

    return [
        'username' => $faker->userName,
        'status'       =>  $faker->randomElement(['closed', 'open']),
        'full_name' => $firstName . ' ' . $lastName,
        'cnic'      => $faker->numberBetween(11111,99999) . '-' . $faker->numberBetween(1111111,9999999) . '-' . $faker->numberBetween(0, 9),
        'email' => $faker->email,
        'password' => Hash::make($password),
        'url' => $faker->url,
        'picture' => $faker->imageUrl(400,400, 'people'),
        'contact_number' => '0' . $faker->numberBetween(300,350) . '-' . $faker->numberBetween(1000000,9999999),
        'user_role'       =>  $faker->randomElement(['admin', 'staff', 'auctioneer', 'bidder']),
        'updated_by'      => null,
        'remember_token' => null,
        'deleted_at' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi')
    ];
});

$factory(\Modules\Cars\Entities\Car::class, function ($faker) {


    $users_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $users_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();

    $engine_types_des = \Modules\EngineTypes\Entities\EngineType::orderBy('id', 'desc')->get();
    $engine_types_asc = \Modules\EngineTypes\Entities\EngineType::orderBy('id', 'asc')->get();


    $car_models_des = \Modules\CarModels\Entities\CarModel::orderBy('id', 'desc')->get();
    $car_models_asc = \Modules\CarModels\Entities\CarModel::orderBy('id', 'asc')->get();



    //dd($users_des[0]->id);


    $min_price = $faker->numberBetween(200000, 3000000);
    $average_price = $faker->numberBetween(300000+$min_price, 9999999);



    return [
        'user_id' => mt_rand($users_asc[0]->id, $users_des[0]->id),
        'title' =>  $faker->userName . ' car',
        'average_price' => $average_price,
        'minimum_price' =>  $min_price,
        'manufacturing_year'    =>  $faker->year,
        'car_model_id' => mt_rand($car_models_asc[0]->id, $car_models_des[0]->id),
        'engine_type_id'   =>  mt_rand($engine_types_asc[0]->id, $engine_types_des[0]->id),
        'trim'          =>  $faker->randomElement(['LE', 'XLE', 'Limited', "ABC"]),
        'exterior_color'    => $faker->hexColor,
        'interior_color'    =>  $faker->hexColor,
        'grade'          =>  $faker->randomElement(['A', 'B', 'C', "D"]),
        'kilometers'    => $faker->numberBetween(800, 99999),
        'engine_number' => $faker->randomLetter . $faker->numberBetween(1, 9999999),
        'chassis_number'    => $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->numberBetween(1, 99959),
        'number_plate'    => $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->numberBetween(1, 9999),
        'city_of_registration'    => $faker->randomElement(['Lahore', 'Karachi', 'Islamabad', 'Peshawar', 'Multan', 'Sialkot', 'Sukkhur', 'Rawalpindi']),
        'transmission'    => $faker->randomElement(['automatic', 'manual']),
        'body_type'    => $faker->randomElement(['Hatchback', 'Sedan', 'MUV/SUV', 'Coupe', 'Convertible', 'Wagon', 'Van', 'Jeep' ]),
        'drivetrain'    => $faker->randomElement(['FWD', 'RWD', 'MUV/SUV', '4WD' ]),
        'deleted_at' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi')
    ];
});

$factory(\Modules\CarModels\Entities\CarModel::class, function ($faker) {

    $companies_des = \Modules\CarCompanies\Entities\CarCompany::orderBy('id', 'desc')->get();
    $companies_asc = \Modules\CarCompanies\Entities\CarCompany::orderBy('id', 'asc')->get();

    return [
        'car_company_id' => mt_rand($companies_asc[0]->id, $companies_des[0]->id),
        'model_name' =>  $faker->randomElement(['Hyundai Galloper', 'Hyundai Santa Fe', 'Hyundai Accent Variants', 'Toyota Aygo', 'Toyota Avalon']),

        'deleted_at' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi')
    ];
});

$factory(\Modules\CarCompanies\Entities\CarCompany::class, function ($faker) {

    return [
        'company_name' => $faker->randomElement(['Hyundai', 'Toyota']),
        'deleted_at' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi')
    ];
});

$factory(\Modules\EngineTypes\Entities\EngineType::class, function ($faker) {

    return [
        'title' => $faker->randomElement(['External combustion (EC)', 'Internal Combustion (IC)', 'Diesel Engine', 'Petrol Engine']),
        'deleted_at' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi')
    ];
});


$factory(\Modules\Auctions\Entities\Auction::class, function ($faker) {

    $car_des = \Modules\Cars\Entities\Car::orderBy('id', 'desc')->get();
    $car_asc = \Modules\Cars\Entities\Car::orderBy('id', 'asc')->get();

    $user_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $user_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();

    $uid = mt_rand($user_asc[0]->id, $user_des[0]->id);

    $bid_starting_amount = mt_rand(80000, 1000000);

    return [
        'start_date' => getRandomDate(),
        'end_date' => getRandomDate(),
        'start_time' => getRandomTime(),
        'end_time' => getRandomTime(),
        'car_id'    => mt_rand($car_asc[0]->id, $car_des[0]->id),
        'bid_starting_amount'   => $bid_starting_amount,
        'winner_user_id'    => $faker->randomElement([null, $uid]),
        'average_bid'   => ( $bid_starting_amount + mt_rand(80000, 500000) ),
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null,
    ];
});


$factory(\Modules\Biddings\Entities\Bidding::class, function ($faker) {

    $auction_des = \Modules\Auctions\Entities\Auction::orderBy('id', 'desc')->get();
    $auction_asc = \Modules\Auctions\Entities\Auction::orderBy('id', 'asc')->get();

    $user_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $user_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();

    $uid = mt_rand($user_asc[0]->id, $user_des[0]->id);
    $auction_id = mt_rand($auction_asc[0]->id, $auction_des[0]->id);

    return [
        'user_id' => $uid,
        'bid_amount' => mt_rand(80000, 5000000),
        'auction_id' => $auction_id,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null,
    ];
});


$factory(\Modules\InspectionRequests\Entities\InspectionRequest::class, function ($faker) {

    $car_des = \Modules\Cars\Entities\Car::orderBy('id', 'desc')->get();
    $car_asc = \Modules\Cars\Entities\Car::orderBy('id', 'asc')->get();

    $user_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $user_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();

    $uid = mt_rand($user_asc[0]->id, $user_des[0]->id);
    $car_id = mt_rand($car_asc[0]->id, $car_des[0]->id);

    return [
        'user_id' => $uid,
        'car_id' => $car_id,
        'date_of_inspection' => getRandomDate(),
        'time_of_inspection' => getRandomTime(),
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Invoices\Entities\Invoice::class, function ($faker) {

    $user_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $user_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();

    $uid = mt_rand($user_asc[0]->id, $user_des[0]->id);

    $payment_for = $faker->randomElement(['account', 'bid']);


    $auction_id = null;
    if ($payment_for == 'bid'){
        $auction_des = \Modules\Auctions\Entities\Auction::orderBy('id', 'desc')->get();
        $auction_asc = \Modules\Auctions\Entities\Auction::orderBy('id', 'asc')->get();

        $auction_id = mt_rand($auction_asc[0]->id, $auction_des[0]->id);
    }

    return [
        'amount' => mt_rand(10000, 7000000),
        'description' => $faker->text(mt_rand(50, 200)),
        'status' => $faker->randomElement(['paid', 'cancelled', 'pending', 'draft']),
        'user_id'   => $uid,
        'payment_method'    => $faker->randomElement(['cash', 'cc', 'bank']),
        'payment_for' => $payment_for,
        'auction_id'    => $auction_id,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Cars\Entities\Category::class, function ($faker) {


    $number = \Modules\Cars\Database\Seeders\CarsDatabaseSeeder::getIterationNumber();
    \Modules\Cars\Database\Seeders\CarsDatabaseSeeder::updateIterationNumber(($number+1));


    $catArr = ['Cars', 'Best Deals', 'Popular', 'Limited Offers', 'Misc', 'Eid Special'];

    $category = $catArr[$number];


    return [
        'category' => $category,
        'category_parent_id' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Cars\Entities\CarCategories::class, function ($faker) {

    $cat_des = \Modules\Cars\Entities\Category::orderBy('id', 'desc')->get();
    $cat_asc = \Modules\Cars\Entities\Category::orderBy('id', 'asc')->get();
    $cat_id = mt_rand($cat_asc[0]->id, $cat_des[0]->id);

    $car_des = \Modules\Cars\Entities\Car::orderBy('id', 'desc')->get();
    $car_asc = \Modules\Cars\Entities\Car::orderBy('id', 'asc')->get();
    $car_id = mt_rand($car_asc[0]->id, $car_des[0]->id);

    return [
        'car_id' => $car_id,
        'category_id' => $cat_id,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Features\Entities\Feature::class, function ($faker) {


    $number = \Modules\Features\Database\Seeders\FeaturesDatabaseSeeder::getIterationNumber();
    \Modules\Features\Database\Seeders\FeaturesDatabaseSeeder::updateIterationNumber(($number+1));

    $features = ['Air Conditioning', 'Keyless Entry', 'Power Steering', 'Alloy Wheels', 'Navigation System',
        'Power Windows', 'Heated Seats', 'Power Locks', 'Rear View Camera', 'Am / FM Sterio', 'Anti-Lock Brakes (ABS)'];

    $feature = $features[$number];


    return [
        'title' => $feature,
        'icon_path' => null,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Cars\Entities\CarFeature::class, function ($faker) {

    $feature_des = \Modules\Features\Entities\Feature::orderBy('id', 'desc')->get();
    $feature_asc = \Modules\Features\Entities\Feature::orderBy('id', 'asc')->get();
    $feature_id = mt_rand($feature_asc[0]->id, $feature_des[0]->id);

    $car_des = \Modules\Cars\Entities\Car::orderBy('id', 'desc')->get();
    $car_asc = \Modules\Cars\Entities\Car::orderBy('id', 'asc')->get();
    $car_id = mt_rand($car_asc[0]->id, $car_des[0]->id);

    return [
        'car_id' => $car_id,
        'feature_id' => $feature_id,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\Notifications\Entities\Notification::class, function ($faker) {

    $user_des = \Modules\Users\Entities\UserModel::orderBy('id', 'desc')->get();
    $user_asc = \Modules\Users\Entities\UserModel::orderBy('id', 'asc')->get();
    $user_id = mt_rand($user_asc[0]->id, $user_des[0]->id);

    $shortMsg = $faker->text(mt_rand(30,70));

    return [
        'is_read' => mt_rand(0,1),
        'user_id' => $user_id,
        'short_msg' => $shortMsg,
        'long_msg' => $shortMsg . ' - ' . $faker->text(mt_rand(80,200)),
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});


$factory(\Modules\GeneralSettings\Entities\GeneralSetting::class, function ($faker) {

    $number = \Modules\GeneralSettings\Database\Seeders\GeneralSettingsDatabaseSeeder::getIterationNumber();
    \Modules\GeneralSettings\Database\Seeders\GeneralSettingsDatabaseSeeder::updateIterationNumber(($number+1));

    $genral_setting_Arr = [
        ['price_unit' , 'PKR'],
        ['max_allowed_days' , 14],
        ['maximum_allowed_bid', 9999999999],
        ['rules_page'    ,null],
        ['terms_and_conditions_page' , null],
    ];

    $general_setting = $genral_setting_Arr[$number];

    return [
        'key' => $general_setting[0],
        'value' => $general_setting[1],
        'is_default' => 1,
        'created_at' => Carbon\Carbon::now('Asia/Karachi'),
        'updated_at' => Carbon\Carbon::now('Asia/Karachi'),
        'deleted_at' => null
    ];
});



function getRandomTime(){
    $startDate = Carbon\Carbon::now()->subMonth(mt_rand(1, 12));
    $endDate   = Carbon\Carbon::now()->addMonths(mt_rand(1,12));

    $randomTime = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('H:m');

    return $randomTime;
}

function getRandomDate(){
    $startDate = Carbon\Carbon::now()->subMonth(mt_rand(1, 12));
    $endDate   = Carbon\Carbon::now()->addMonths(mt_rand(1,12));

    $randomDate = Carbon\Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d');

    return $randomDate;
}


$factory(\Modules\Media\Entities\PostStatus::class, function ($faker) {

    $records = DB::table('post_statuses')->get();

    if (! (sizeof($records) >= 4 ) ) {

        $post_statuses = ['published', 'draft', 'private', 'pending review'];


        if (!isset($_SESSION['post_status_iteration']))
            $_SESSION['post_status_iteration'] = '0';

        $arr = ['status_title' => $post_statuses[$_SESSION['post_status_iteration']],
            'deleted_at' => null,
            'created_at' => Carbon\Carbon::now('Asia/Karachi'),
            'updated_at' => Carbon\Carbon::now('Asia/Karachi')
        ];

        $_SESSION['post_status_iteration']++;

        if ($_SESSION['post_status_iteration'] > 3) {
            $_SESSION['post_status_iteration'] = 0;
        }

        return $arr;
    }
} );

/*$factory('App\Bank_Account',  [
        'user_id' => 'factory:App\User',
        'bank_name' => 'Bank ' . $faker->name . ' LTD',
        'account_number'    =>  $faker->bankAccountNumber,
        'name_on_cc'        =>  $faker->name,
        'cc_number'         =>  $faker->year,
        'cvv'               =>  mt_rand(1000, 9999),
        'sale_price'               =>  $faker->numberBetween(50, 999999) . '.' . $pointValue,
        'weight'        =>  $faker->numberBetween(0,5),
        'weight_unit'   =>  $faker->randomElement(['g' ,'kg', 'mg']),
        'sku'   =>  $faker->isbn10,
        'availability'  =>  '',
        'is_featured'   =>  mt_rand(0, 1),
        'is_free_shipping'  =>  mt_rand(0,1),
        'discount'  =>  $faker->image(dir, w, h, c, b),







    ]
 );*/
