<?php

namespace Modules\EngineTypes\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CommonBackend\Http\Filters;
use Modules\EngineTypes\Http\Filters\EngineTypesFilter;
use Modules\EngineTypes\Entities\EngineType;

class EngineTypesController extends Controller
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
        $filter->column = ['id','title'];
        $engineTypes = EngineType::filter($filter)
            ->paginate(\Helper::limit($request));
        return view('enginetypes::index', compact('engineTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('enginetypes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:engine_types,title',
        ]);

        $isSuccess = EngineType::create($request->only('title'));
        return ($isSuccess) ?
            back()->with('alert-success', 'Engine Type Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('enginetypes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $engineType = EngineType::find($id);
        if(!$engineType) return redirect()->route(Helper::route('index'));

        return view('enginetypes::edit', compact('engineType'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:engine_types,title,'.$id,
        ]);

        if (!$engineType = EngineType::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $engineType->update(
            $request->only('title')
        );
        return ($isSuccess) ?
            back()->with('alert-success', 'Engine Type Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = EngineType::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
