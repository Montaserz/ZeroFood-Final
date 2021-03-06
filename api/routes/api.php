<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('user/balance/{amount}', 'App\\Api\\V1\\Controllers\\UserController@addtoBalance');
        $api->get('user/balance', 'App\\Api\\V1\\Controllers\\UserController@showBalance');
        $api->get('user/orders', 'App\\Api\\V1\\Controllers\\OrderController@showUserOrders');
        $api->get('user/orders/{id}', 'App\\Api\\V1\\Controllers\\OrderController@show');
        $api->get('user/orders/delete/{id}', 'App\\Api\\V1\\Controllers\\OrderController@destory');
        $api->post('user/orders/create', 'App\\Api\\V1\\Controllers\\OrderController@store');


        $api->get('admin/orders', 'App\\Api\\V1\\Controllers\\OrderController@index');
        $api->put('admin/orders/{id}', 'App\\Api\\V1\\Controllers\\OrderController@update');


        $api->post('meals/store', 'App\\Api\\V1\\Controllers\\MealController@store');
        $api->put('meals/update/{id}', 'App\\Api\\V1\\Controllers\\MealController@update');
        $api->get('meals/delete/{id}', 'App\\Api\\V1\\Controllers\\MealController@destory');
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);

        });

        $api->get('refresh', ['middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });
    $api->get('meals', 'App\\Api\\V1\\Controllers\\MealController@index');
    $api->get('meals/{id}', 'App\\Api\\V1\\Controllers\\MealController@show');



    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
