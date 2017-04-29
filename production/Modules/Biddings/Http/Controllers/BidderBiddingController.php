<?php

namespace Modules\Biddings\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auctions\Entities\Auction;
use Modules\Biddings\Entities\Bidding;
use Modules\Cars\Entities\Car;
use Modules\CommonBackend\Http\Filters;
use Modules\Users\Entities\UserModel;

class BidderBiddingController extends Controller
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
        $filter->column = ['id','bid_amount', 'user_id', 'auction_id'];
        $filter->belongsToThrough = [Auction::class => ['bid_starting_amount'], Car::class => ['title']];
        $biddings = Bidding::filter($filter)
            ->where('biddings.user_id', \Auth::user()->id)
            ->with('auction')
            ->paginate(\Helper::limit($request));
        return view('biddings::bidder.index', compact('biddings'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $bid = Bidding::whereId($id)->with(['auction.car', 'user'])->firstOrFail();
        if (!$bid) return redirect()->route(Helper::route('index'));

        return view('biddings::edit', compact('bid'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'amount' => 'required',
        ]);

//        return $bid = Bidding::find($id);
        if (!$bid = Bidding::find($id)) return back();

        if($request->amount < $bid->auction->bid_starting_amount){
            return back()->with('alert-danger', 'Error: Min Bid Amount Is '. $bid->auction->bid_starting_amount);
        }
        $bid->bid_amount = $request->amount;
        $isSuccess = $bid->save();

        return ($isSuccess) ?
            back()->with('alert-success', 'Bid Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

}
