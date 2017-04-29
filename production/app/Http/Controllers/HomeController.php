<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auction\AuctionController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Auctions\Entities\Auction;
use Modules\Media\Entities\Post;

class HomeController extends Controller
{
    public function index()
    {

        $auctions = Auction::with(['car.engineType', 'car.carModel.carCompany', 'car.meta' => function($query){
            $query->where('meta_key', 'picture');
        }])
            ->where('end_date', '>=', date('Y-m-d'))
            ->latest()->get();

        $helpPage = Post::where('slug' , 'help-page')->with('post_status')->first();
        $rulesPage = Post::where('slug' , 'rules-page')->with('post_status')->first();

        return view('home.index',
            (new AuctionController())->getFields($auctions))
            ->withAuctions($auctions)->with(['helpPage' => $helpPage, 'rulesPage' => $rulesPage]);

    }
}
