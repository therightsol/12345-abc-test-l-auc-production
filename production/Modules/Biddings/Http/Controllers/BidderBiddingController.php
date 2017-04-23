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
        $filter->column = ['bid_amount', 'user_id'];
        $filter->belongsToThrough = [Auction::class => ['id','bid_starting_amount'], Car::class => ['title']];
        $biddings = Bidding::filter($filter)
            ->where('biddings.user_id', \Auth::user()->id)
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
            'auction_id' => 'required',
            'user_id' => 'required',
            'bid_amount' => 'required',
        ]);

        if (!$bid = Bidding::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $bid->update(
            $request->only('user_id', 'auction_id', 'bid_amount')
        );

        return ($isSuccess) ?
            back()->with('alert-success', 'Bid Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = Bidding::find($id);
        if (empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
