<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Order;
use App\User;
use App\Meal;
use Dingo\Api\Routing\Helpers;
use Auth;

class OrderController extends Controller
{
    use Helpers;
    public function index()
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
          //  return Order::all()->toJson();
                return DB::table('users')
                    ->join('orders', 'users.id', '=', 'orders.user_id')
                    ->join('meals', 'meals.id', '=', 'orders.meals_id')
                    ->select('meals.name','users.email','orders.total','orders.created_at')->get();

        }
        return $this->response->error('unauthorized',403);
    }
    public function showUserOrders()
    {
        $id = Auth::guard()->user()->id;
        $order =  DB::table('users')
            ->where('users.id',$id)
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('meals', 'meals.id', '=', 'orders.meals_id')
            ->select('orders.id', 'meals.name', 'meals.info', 'orders.total','orders.created_at','orders.status')->get();

        if(!$order) {
            return 'no orders';
        }
        return $order;
    }
    public function show($id)
    {
        $user_id = Auth::guard()->user()->id;
        $user = User::find($user_id);
        $user_id = $user->id;
        $order = Order::where('id',$id)->first();
        if(!$order) {
            return 'not found';
        }
        return $order;
    }
    //TODO: change to server side order completion and route needed
    public function store(Request $request)
    {
        $user_id = Auth::guard()->user()->id;
        $user = User::find($user_id);
        $user_id = $user->id;
        $meal_price = Meal::where('id',$request->post('meals_id'))->first()->price;
        if($user->balance<$meal_price){
            $this->response->error('Not enough balance', 403);
        }
        $user->balance -= $meal_price;
        $user->save();
        $order = new Order();
        $order->meals_id = $request->post('meals_id');
        $order->status = 'processing';
        $order->total = $meal_price;
        $user->orders()->save($order);
        return $this->response->accepted();
    }
    public function update(Request $request, $id)
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
            Order::where('id',$id)->update($request->all());
            return $this->response->accepted();
        }
        return $this->response->error('unauthorized',403);
    }
    public function destory($id)
    {
        $role = Auth::guard()->user()->role;
        if($role===1){
            Order::where('id',$id)->delete();
            return $this->response->accepted();
        }
        return $this->response->error('unauthorized',403);
    }
}
