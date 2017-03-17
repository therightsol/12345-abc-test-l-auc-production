<?php

namespace Modules\CommonBackend\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\CommonBackend\Providers\CommonBackendServiceProvider;
use Modules\Users\Entities\UserModel;
use Nwidart\Modules\Facades\Module;

class CommonBackendController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        return view('commonbackend::index');


    }
}
