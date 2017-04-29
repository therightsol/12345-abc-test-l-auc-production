<?php

namespace Modules\Auctions\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Auctions\Entities\Auction;
use Modules\CarModels\Entities\CarModel;
use Modules\Cars\Entities\Car;
use Modules\CommonBackend\Http\Filters;
use Modules\Users\Entities\UserModel;

class BidderAuctionController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @param Filters $filter
     * @param Request $request
     * @return Response
     */
    public function index(Filters $filter, Request $request)
    {
        $filter->belongsTo = [Car::class =>['title']];
        $filter->column = ['id'];
        $auctions = Auction::filter($filter)
            ->with(['bidding' => function($q){{
                $q->where('user_id', \Auth::user()->id)->first();
            }}])
            ->where('winner_user_id', \Auth::user()->id)
            ->paginate(\Helper::limit($request));

//        return $auctions;
        return view('auctions::bidder.index', compact('auctions'));
    }


}
