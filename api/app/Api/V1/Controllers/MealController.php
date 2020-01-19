<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;
use App\Meal;
use Dingo\Api\Routing\Helpers;
use Auth;

class MealController extends Controller
{
    use Helpers;
    public function index()
    {
    return Meal::all()->toJson();
    }
    public function show($id)
    {
        $meal = Meal::where('id',$id)->first();

        if(!$meal) {
            return 'not found';
        }
        return $meal;
    }

    public function store(Request $request)
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
            Meal::create($request->all());
            return $this->response->created();
        }
        return $this->response->error('unauthorized',403);
    }
    public function update(Request $request, $id)
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
            Meal::where('id',$id)->update($request->all());
            return $this->response->accepted();
        }
        return $this->response->error('unauthorized',403);
    }
    public function destory($id)
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
            Meal::where('id',$id)->delete();
            return $this->response->accepted();
        }
        return $this->response->error('unauthorized',403);
    }
}
