<?php

namespace Modules\Features\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CommonBackend\Http\Filters;
use Modules\Features\Entities\Feature;
use Modules\Features\Http\Filters\FeaturesFilter;

class FeaturesController extends Controller
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
        $filter->column = ['id','title', 'icon_path'];
        $features = Feature::filter($filter)
            ->paginate(\Helper::limit($request));
        return view('features::index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('features::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:features,title',
        ]);

        $isSuccess = Feature::create($request->only('title','icon_path'));
        return ($isSuccess) ?
            back()->with('alert-success', 'Feature Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('features::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $feature = Feature::find($id);
        if(!$feature) return redirect()->route(Helper::route('index'));

        return view('features::edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:features,title,'.$id,
        ]);

        if (!$feature = Feature::find($id)) return redirect()->route(Helper::route('index'));
        $isSuccess = $feature->update(
            $request->only('title','icon_path')
        );
        return ($isSuccess) ?
            back()->with('alert-success', 'Feature Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = Feature::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
