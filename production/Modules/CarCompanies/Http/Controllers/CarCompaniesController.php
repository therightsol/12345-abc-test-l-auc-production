<?php

namespace Modules\CarCompanies\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CarCompanies\Entities\CarCompany;
use Modules\CarCompanies\Http\Filters\CarCompaniesFilter;
use Modules\CommonBackend\Http\Filters;

class CarCompaniesController extends Controller
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
        $filter->column = ['id','company_name'];
        $carCompanies = CarCompany::filter($filter)
            ->paginate(\Helper::limit($request));
        return view('carcompanies::index', compact('carCompanies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('carcompanies::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'company_name' => 'required|unique:car_companies,company_name'
        ]);

        $isSuccess = CarCompany::create([
            'company_name' => $request->input('company_name')
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Car Company Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('carcompanies::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $carCompany = CarCompany::find($id);
        if(!$carCompany) return redirect()->route(Helper::route('index'));
        return view('carcompanies::edit', compact('carCompany'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name' => 'required|unique:car_companies,company_name,' . $id
        ]);

        if (!$carCompany = CarCompany::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $carCompany->update([
            'company_name' => $request->input('company_name')
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Car Company Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = CarCompany::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
