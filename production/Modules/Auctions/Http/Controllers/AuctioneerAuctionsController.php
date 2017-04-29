<?php

namespace Modules\Auctions\Http\Controllers;

use App\Notifications\AuctionWinner;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auctions\Entities\Auction;
use Modules\Cars\Entities\Car;
use Modules\CommonBackend\Http\Filters;
use Modules\Users\Entities\UserModel;

class AuctioneerAuctionsController extends Controller
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
        $filter->belongsTo = [Car::class => ['title']];
        $filter->column = ['id', 'bid_starting_amount','winner_user_id', 'average_bid', 'start_date', 'end_date'];
        $auctions = Auction::filter($filter)
            ->whereHas('car', function ($q) {
                $q->where('user_id', \Auth::user()->id);
            })
            ->with('bidding')
            ->paginate(\Helper::limit($request));


        return view('auctions::auctioneer.index', compact('auctions'));
    }

    public function auctionBids($id)
    {
        $auction = Auction::whereId($id)->with('bidding.user')->first();
//        return $auction;
        return view('auctions::auctioneer.biddings', compact('auction'));
    }

    public function winner($id, Request $request)
    {
        $auction = Auction::find($id);
        $user = UserModel::find($request->id);
        $auction->winner_user_id = $request->id;
        $auction->save();

        $user->notify(new AuctionWinner($auction));


        return back()->with('alert-success', 'Winner Declare');
    }

}
