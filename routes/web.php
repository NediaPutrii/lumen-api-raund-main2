<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return ["Hello Hai ini repo kedua..!!!"];
});

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');

$router->group(['prefix' => 'auth'], function() use($router){
    // $router->post('/register', 'AuthController@register');
    // $router->post('/login', 'AuthController@login');
});

$router->group(['middleware' => 'auth'], function($router){
    //logout
    $router->post('/logout', 'AuthController@logout');

    

    //profil
    // $router->get('/saved_address', function () use ($router) {
    //     $results = app('db')->select("SELECT * FROM saved_addresses");
    //     return response()->json($results);
    // });
    $router->get('/saved_address/{nim}', 'SavedAddressController@show');

    //ongoing
    $router->get('/myongoing', 'OngoingController@show');

    //myhistory
    $router->get('/myhistory', 'HistoryController@show');

    //mysetting
    $router->get('/mysetting', 'UserController@show');

    $router->get('/mysettings', 'UserController@shows');

    //mobil
    $router->get('/mobil/{id_travel_agent}', 'MobilController@show');

    //editprofil
    $router->put('/myedit', 'UserController@edit');

    //editprofil
    $router->put('/myedits', 'UserController@edits');

    //changepassword
    $router->put('/mypassword', 'UserController@changepassword');

    //tambah transaksi travel
    $router->post('/addtravel', 'TravelController@tambahtravel');

    //tambah transaksi delivery
    $router->post('/adddelivery', 'TravelController@tambahdelivery');



    // edit travel
    $router->put('/edittravel', 'TravelController@edittravel');

    // edit delivery
    $router->put('/editdelivery', 'TravelController@editdelivery');

    //tambahtravelbaru
      $router->post('/addtravelbaru', 'TravelAgentController@tambahtravelagent');

       //tambahmobilbaru
       $router->post('/addmobil', 'MobilController@tambahmobil');
});
    //tambah travel agen
    $router->put('/editstatus', 'OngoingController@edits');

    //tambahtravelbaru
    $router->post('/addtravelbaru', 'TravelAgentController@tambahtravelagent');

    //tambahmobilbaru
    $router->post('/addmobil', 'MobilController@tambahmobil');

$router->get('/travel_agent', 'TravelAgentController@index');
//travel
$router->get('/choose_travel', 'TravelAgentController@index');
$router->get('/mobil', 'MobilController@index');
// $router->get('/travel_agent', function () use ($router) {
//     $results = app('db')->select("select mobils.id as id_mobil , * from mobils join travel_agents on mobils.id_travel_agent=travel_agents.id_travel_agent");
//     return response()->json($results);
// });
// $router->post('/saved_address', 'SavedAddressController@store');
// $router->post('/travel_agent_store', 'TravelAgentController@store');
// $router->get('/savedaddress/{nim}', function () use ($router) {
//     $results = app('db')->select("SELECT * FROM saved_address where nim=$nim");
//     return response()->json($results);
// });