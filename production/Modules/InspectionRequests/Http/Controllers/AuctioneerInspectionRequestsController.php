<?php

namespace Modules\InspectionRequests\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CarCompanies\Entities\CarCompany;
use Modules\CarMetas\Entities\CarMeta;
use Modules\Cars\Entities\Car;
use Modules\Cars\Entities\Category;
use Modules\CommonBackend\Http\Filters;
use Modules\EngineTypes\Entities\EngineType;
use Modules\Features\Entities\Feature;
use Modules\InspectionRequests\Entities\InspectionRequest;
use Modules\Users\Entities\UserModel;

class AuctioneerInspectionRequestsController extends Controller
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
        $filter->belongsTo = [UserModel::class =>['username']];
        $filter->column = ['id','date_of_inspection', 'time_of_inspection'];
        $inspections = InspectionRequest::filter($filter)
            ->paginate(\Helper::limit($request));

        return view('inspectionrequests::index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Response
     */
    public function create()
    {

        if(\Session::has('auctioneer.car')){
            $car = \Session::get('auctioneer.car');
//            return $car;
            return view('inspectionrequests::auctioneer.create', compact('car'));
        }else{
            $carCompanies = CarCompany::pluck('company_name', 'id');
            $categories = Category::pluck('category', 'id');
            $engine_types = EngineType::pluck('title', 'id');
            $features = Feature::pluck('title', 'id');

            return view('inspectionrequests::auctioneer.create',
                compact('carCompanies', 'categories','engine_types', 'features'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeCar(Request $request)
    {


        $this->validate($request,[
            'title' => 'required',
            'car_model_id' => 'required',
            'kilometers' => 'integer|min:0',
        ]);

        $gallery_images = $request->has('gallery_images_ids') ? $request->input('gallery_images_ids') : '';

        $inputArr = $request->only(
            'title', 'car_model_id', 'engine_type_id', 'trim',
            'exterior_color', 'interior_color', 'grade','manufacturing_year',
            'kilometers', 'number_plate','engine_number', 'chassis_number',
            'city_of_registration', 'transmission', 'body_type', 'drivetrain');

        $inputArr['user_id'] = \Auth::id();


        $car = Car::create(
            $inputArr
        );

        if($car){
            $car->meta()->saveMany([
                new CarMeta(['meta_key' => 'picture', 'meta_value' => $request->input('picture')]),
                new CarMeta(['meta_key' => 'gallery', 'meta_value' => ($gallery_images)])
            ]);
            $car->categories()->attach($request->input('categories'));
            $car->features()->attach($request->input('features'));

            \Session::put('auctioneer.car', $car);

            return back();
        }

        return back()->with('alert-danger', 'Error: please try again.');

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'date_of_inspection' => 'required',
        ]);

        $car = \Session::get('auctioneer.car');

        if(!$car) return back();

        $sdate = explode('--', $request->input('date_of_inspection'));
        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);

        $isSuccess = InspectionRequest::create([
            'car_id' => $car->id,
            'user_id' => \Auth::user()->id,
            'date_of_inspection' => $start_date,
            'time_of_inspection' => $start_time,
        ]);

        \Session::forget('auctioneer.car');

        return ($isSuccess) ?
            back()->with('alert-success', 'Inspection Request Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('inspectionrequests::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $inspection = InspectionRequest::whereId($id)->with(['car', 'user'])->first();
        if(!$inspection) return redirect()->route(Helper::route('index'));
        return view('inspectionrequests::edit', compact('inspection'));
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
            'user_id' => 'required',
            'date_of_inspection' => 'required',
        ]);
        $sdate = explode('--', $request->input('date_of_inspection'));
        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);

        if (!$inspection = InspectionRequest::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $inspection->update([
            'car_id' => $request->input('car_id'),
            'user_id' => $request->input('user_id'),
            'date_of_inspection' => $start_date,
            'time_of_inspection' => $start_time,
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Inspection Request Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = InspectionRequest::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
