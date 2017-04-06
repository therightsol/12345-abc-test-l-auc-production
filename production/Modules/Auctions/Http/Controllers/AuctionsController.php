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

class AuctionsController extends Controller
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
        $filter->column = ['id','bid_starting_amount', 'average_bid', 'start_date', 'end_date'];
        $auctions = Auction::filter($filter)
            ->paginate(\Helper::limit($request));
        Session::forget('auction.car');

        return view('auctions::index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Response
     */
    public function create()
    {
        return view('auctions::create', compact('cars'));
    }

    public function searchCar(Request $request)
    {
        $term = trim($request->search);

        if (empty($term)) {
            return \Response::json([]);
        }

        $cars = Car::with(['carModel.carCompany', 'meta' => function($query){
            $query->where('meta_key', 'picture');
            $query->select('car_id','meta_value');
        }])
            ->orWhere('title','like', '%'.$term.'%')

            ->orWhereHas('carModel', function($query) use($term){
                $query->where('model_name', 'like', '%'.$term.'%');
            })->orWhereHas('carModel.carCompany', function($query) use($term){
                $query->where('company_name', 'like', '%'.$term.'%');
            })
            ->limit(20)->latest()->get();

        $formatted = [];

        foreach ($cars as $car) {

            $formatted[] = [
                'id' => $car->id,
                'text' => $car->title,
                'info' => $car->toArray()
            ];

        }


        return \Response::json($formatted);
    }


    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $sdate = explode('--', $request->input('start_date'));
        $edate = explode('--', $request->input('end_date'));
        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);
        $end_date = Carbon::createFromFormat('d F Y', trim($edate[0]));
        $end_time = trim($edate[1]);

        $isSuccess = Auction::create([
            'car_id' => $request->input('car_id'),
            'bid_starting_amount' => $request->input('bid_starting_amount'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        Session::forget('auction.car');
        return ($isSuccess) ?
            back()->with('alert-success', 'Auction Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('auctions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $auction = Auction::find($id);
        if(!$auction) return redirect()->route(Helper::route('index'));
        $cars = Car::pluck('title', 'id');

        return view('auctions::edit', compact('auction', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'car_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $sdate = explode('--', $request->input('start_date'));
        $edate = explode('--', $request->input('end_date'));

        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);
        $end_date = Carbon::createFromFormat('d F Y', trim($edate[0]));
        $end_time = trim($edate[1]);

        if (!$auction = Auction::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $auction->update([
            'car_id' => $request->input('car_id'),
            'bid_starting_amount' => $request->input('bid_starting_amount'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Auction Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = Auction::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
