<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cars\Http\Filters\CategoryFilter;
use Modules\Cars\Entities\Category;
use Modules\CommonBackend\Http\Filters;

/**
 * Class CategoryController
 * @package Modules\Cars\Http\Controllers
 */
class CategoryController extends Controller
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
        $filter->column = ['id','category'];
        $categories = Category::filter($filter)
            ->paginate(\Helper::limit($request));

        return view('cars::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cars::category.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories,category'
        ]);

        $isSuccess = Category::create([
            'category' => $request->input('category')
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Category Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('cars::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category) return redirect()->route(Helper::route('index'));
        return view('cars::category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories,category,' . $id
        ]);


        if (!$category = Category::find($id)) return back()->with('alert-danger', 'Error: please try again.');
        $isSuccess = $category->update([
            'category' => $request->input('category')
        ]);
        return ($isSuccess) ?
            back()->with('alert-success', 'Category Created Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = Category::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
