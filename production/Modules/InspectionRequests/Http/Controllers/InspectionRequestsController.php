<?php

namespace Modules\InspectionRequests\Http\Controllers;

use App\Notifications\InspectionCompleted;
use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cars\Entities\Car;
use Modules\CommonBackend\Http\Filters;
use Modules\GeneralSettings\Entities\GeneralSetting;
use Modules\InspectionRequests\Entities\InspectionRequest;
use Modules\Users\Entities\UserModel;

class InspectionRequestsController extends Controller
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

        $filter->belongsTo = [UserModel::class => ['username'], Car::class => ['title', 'is_inspection_complete']];
        $filter->column = ['id', 'date_of_inspection', 'time_of_inspection'];
        $query = InspectionRequest::query();
        $query->filter($filter);
        $inspection_unique_id = GeneralSetting::where('key', 'inspection_unique_id')->first();
        if ($inspection_unique_id) {
            $inspection_unique_id = $inspection_unique_id->value;
//            return ltrim($request->search, $inspection_unique_id);
            if(ltrim($request->search, $inspection_unique_id)){
                $query->orWhere('inspection_requests.id',ltrim($request->search, $inspection_unique_id));
            }
        }


        $inspections = $query->paginate(\Helper::limit($request));


        return view('inspectionrequests::index', compact('inspections', 'inspection_unique_id'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Response
     */
    public function create()
    {
        return view('inspectionrequests::create');
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
            'date_of_inspection' => 'required',
        ]);

        $sdate = explode('--', $request->input('date_of_inspection'));
        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);


        $car = Car::find($request->car_id);

        $inspection = InspectionRequest::create([
            'car_id' => $request->input('car_id'),
            'user_id' => $car->user_id,
            'date_of_inspection' => $start_date,
            'time_of_inspection' => $start_time,
        ]);

        if ($request->input('is_inspection_complete')) {

            $car->is_inspection_complete = 1;
            $car->save();

            $user = UserModel::find($car->user_id);
            $user->notify(new InspectionCompleted($inspection));
        }

        return ($inspection) ?
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
        if (!$inspection) return redirect()->route(Helper::route('index'));
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
            'date_of_inspection' => 'required',
        ]);
        $sdate = explode('--', $request->input('date_of_inspection'));
        $start_date = Carbon::createFromFormat('d F Y', trim($sdate[0]));
        $start_time = trim($sdate[1]);

        $car = Car::find($request->car_id);

        if (!$inspection = InspectionRequest::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $inspection->update([
            'car_id' => $request->input('car_id'),
            'user_id' => $car->user_id,
            'date_of_inspection' => $start_date,
            'time_of_inspection' => $start_time,
        ]);
        $car->is_inspection_complete = $request->is_inspection_complete;
        $car->save();
        if ($request->is_inspection_complete) {
            $user = UserModel::find($car->user_id);
            $user->notify(new InspectionCompleted($inspection));
        }
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
        if (empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
