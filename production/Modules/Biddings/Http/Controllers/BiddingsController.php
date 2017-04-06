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

class BiddingsController extends Controller
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
        $filter->column = ['id', 'bid_amount'];
        $filter->belongsToThrough = [Auction::class => ['bid_starting_amount'], Car::class => ['title']];
        $filter->belongsTo = [UserModel::class => ['full_name']];
        $biddings = Bidding::filter($filter)
            ->paginate(\Helper::limit($request));
//        return $biddings;
        return view('biddings::index', compact('biddings'));
    }
    
    public function searchAuction(Request $request)
    {
        $term = trim($request->search);

        if (empty($term)) {
            return \Response::json([]);
        }

        $auctions = Auction::with(['car.carModel.carCompany', 'car.meta' => function($query){
            $query->where('meta_key', 'picture');
            $query->select('car_id','meta_value');
        }])
            ->orWhereHas('car', function($query) use($term){
                $query->where('title','like', '%'.$term.'%');
            })->orWhereHas('car.carModel', function($query) use($term){
                $query->where('model_name', 'like', '%'.$term.'%');
            })->orWhereHas('car.carModel.carCompany', function($query) use($term){
                $query->where('company_name', 'like', '%'.$term.'%');
            })
            ->limit(20)->latest()->get();

        $formatted_auctions = [];

        foreach ($auctions as $auction) {
            $formatted_auctions[] = [
                'id' => $auction->id,
                'text' => $auction->car->title,
                'min' => $auction->bid_starting_amount,
                'info' => $auction->car];
        }

        return \Response::json($formatted_auctions);
    }
    public function searchUser(Request $request)
    {
        $term = trim($request->search);

        if (empty($term)) {
            return \Response::json([]);
        }

        $users = UserModel::where('full_name',  'like', '%'.$term.'%')
        ->orWhere('email',  'like', '%'.$term.'%')
            ->orWhere('username',  'like', '%'.$term.'%')
            ->limit(20)->latest()->get();

        $formatted_auctions = [];

        foreach ($users as $user) {
            $formatted_auctions[] = ['id' => $user->id, 'text' => $user->full_name, 'info' => $user];
        }

        return \Response::json($formatted_auctions);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('biddings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'auction_id' => 'required',
            'user_id' => 'required',
            'bid_amount' => 'required',
        ]);

        $isSuccess = Bidding::create($request->only('user_id', 'auction_id', 'bid_amount'));
        return ($isSuccess) ?
            back()->with('alert-success', 'Bid Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('biddings::show');
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
