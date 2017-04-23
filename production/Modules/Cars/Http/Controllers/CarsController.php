<?php

namespace Modules\Cars\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CarCompanies\Entities\CarCompany;
use Modules\CarMetas\Entities\CarMeta;
use Modules\CarModels\Entities\CarModel;
use Modules\Cars\Entities\CarCategories;
use Modules\Cars\Entities\CarFeature;
use Modules\Cars\Entities\Car;
use Modules\Cars\Entities\Category;
use Modules\Cars\Http\Filters\CarFilter;
use Modules\CommonBackend\Http\Filters;
use Modules\EngineTypes\Entities\EngineType;
use Modules\Features\Entities\Feature;
use Modules\Media\Entities\Post;
use function Sodium\add;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    use ValidatesRequests;

    public function index(Filters $filter, Request $request)
    {

        $filter->belongsTo = [CarModel::class => ['model_name']];
        $filter->column = ['id','title','car_model_id','grade','manufacturing_year'];

        $cars = Car::filter($filter)
            ->paginate(\Helper::limit($request));

        return view('cars::index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $carCompanies = CarCompany::pluck('company_name', 'id');
//        $car_model_ids = CarModelsModel::pluck('car_model_id_name', 'id');
        $categories = Category::pluck('category', 'id');
        $engine_types = EngineType::pluck('title', 'id');
        $features = Feature::pluck('title', 'id');
        return view('cars::create', compact('carCompanies', 'categories','engine_types', 'features'));

    }

    public function getModels(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'id' => "required|integer",
            ]);

            return CarModel::where('car_company_id', $request->input('id'))->get(['id', 'model_name']);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'car_model_id' => 'required',
            'kilometers' => 'integer|min:0',
        ]);
	
		$gallery_images = $request->has('gallery_images_ids') ? $request->input('gallery_images_ids') : '';
	
		/*dd(\Auth::id());
		
		dd($request->all());*/
		
		$inputArr = $request->only(
			'title', 'car_model_id', 'engine_type_id', 'trim',
			'exterior_color', 'interior_color', 'grade','manufacturing_year',
			'kilometers', 'number_plate','engine_number', 'chassis_number',
			'city_of_registration', 'transmission', 'body_type', 'drivetrain');
		
		$inputArr['user_id'] = \Auth::id();
		
		
		$isSuccess = Car::create(
           $inputArr
        );
		
        $isSuccess->meta()->saveMany([
            new CarMeta(['meta_key' => 'picture', 'meta_value' => $request->input('picture')]),
            new CarMeta(['meta_key' => 'gallery', 'meta_value' => ($gallery_images)])
        ]);
        $isSuccess->categories()->attach($request->input('categories'));
        $isSuccess->features()->attach($request->input('features'));
        return ($isSuccess)?
            back()->with('alert-success', 'Car Created Successfully')
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

        $carCompanies = CarCompany::pluck('company_name', 'id');
        $categories = Category::pluck('category', 'id');
        $engine_types = EngineType::pluck('title', 'id');
        $features = Feature::pluck('title', 'id');

        $car = Car::whereId($id)->with(
            ['engineType','categories','carModel.carCompany','features', 'meta']
        )->first();

        $carMeta = $car->meta->pluck('meta_value', 'meta_key');
        $featured_img = isset($carMeta['picture'])?$carMeta['picture']:false;
		$gallery_images = isset($carMeta['gallery'])?$carMeta['gallery']:false;

        /*if(!empty($imagesArr)){
            $imagesArr = Post::whereIn('id', $imagesArr)->pluck('content', 'id');
        }*/
        $carCompanyModels = CarModel::where('car_company_id', $car->carModel->carCompany->id)->pluck('model_name', 'id');

        //echo '<tt><pre>' . var_export(json_encode($gallery_images), true) . '</pre></tt>';
        
		/*$gallery_images = isset($gallery_images[0]) ? json_decode($gallery_images): "";
		
		var_export($gallery_images);
			exit('----');*/
        
        
        return view('cars::edit', compact('gallery_images','featured_img','car','carCompanies','carCompanyModels', 'categories','engine_types', 'features'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'car_model_id' => 'required',
            'kilometers' => 'integer|min:0',
        ]);
        if (!$car = Car::find($id)) return back()->with('alert-danger', 'Error: please try again.');

        $isSuccess = $car->update(
            $request->only(
                'title', 'car_model_id', 'engine_type_id', 'trim',
                'exterior_color', 'interior_color', 'grade','manufacturing_year',
                'kilometers', 'number_plate','engine_number', 'chassis_number',
                'city_of_registration', 'transmission', 'body_type', 'drivetrain')
        );
        $car->meta()->forceDelete();
		$gallery_images = $request->has('gallery_images_ids') ? $request->input('gallery_images_ids') : '';
        $car->meta()->saveMany([
            new CarMeta(['meta_key' => 'picture', 'meta_value' => $request->input('picture')]),
            new CarMeta(['meta_key' => 'gallery', 'meta_value' => $gallery_images])
        ]);
        ($request->input('categories'))
            ? $car->categories()->sync($request->input('categories'))
            : $car->categories()->detach();
        ($request->input('features'))
            ? $car->features()->sync($request->input('features'))
            : $car->features()->detach();
        return ($isSuccess)?
            back()->with('alert-success', 'Car Updated Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $rec = Car::find($id);
        if(empty($rec)) return;
        return ($rec->forceDelete()) ? 'true' : 'false';
    }
}
