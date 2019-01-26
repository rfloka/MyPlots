<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
use Illuminate\Auth\Middleware\Authenticate;

Route::get('getapi', 'ShowUser@getapi');
Route::post('/sendkey', 'MailController@sendkey');
Route::get('/', 'PlotsController@terre')->middleware('auth');
Route::get('/mapsplot', 'PlotsController@terre')->middleware('auth');
Route::get('/emaildetalhes/{id}', 'ShowUser@email')->middleware('auth');
Route::get('/map/{id}', 'PlotsController@map')->middleware('auth');
Route::get('/transf/{id}', 'PlotsController@transf')->middleware('auth');
Route::get('/transf/{id}/{id2}/{plot}', 'PlotsController@confirmado')->middleware('auth');
Route::get('/ownerpro/{id}', 'ShowUser@utili', function () {
    $user = DB::table('users')->get();
    return view('AllUsers', ['user' => $user]);
});
Route::post('/getinfo', 'PlotsController@mapsinfo');
Route::post('/mensage', 'MailController@send');
Route::get('/addplot/{id}', 'ShowUser@addPlot');
Route::get('/inbox/{email}', 'ShowUser@inbox');
Route::get('/registar', function () {
    return view('PedirRegi');
});
Route::get('/ownerpro/editaruser/{id}', 'ShowUser@editaruser');
Route::get('/eliminaruser/{id}', 'ShowUser@eliminaruser');
Route::get('/eliminarterreno/{id}', 'PlotsController@eliminarplot');
Route::get('/doc/{doco}', 'ShowUser@ShowDoc');
Route::post('/store', 'ShowUser@addPlotDB');
Route::post('/addfoto', 'ShowUser@addfoto');
Route::post('/alterar', 'PlotsController@alterarplotDB');
Route::post('/alteraruser', 'Showuser@alteraruserDB');
Route::post('/changerole', 'ShowUser@changerole');
Route::get('/unveryacc', function () {
    return view('unveryacc');
})->middleware('auth');
Route::post('/pedir', 'MailController@info');
Route::get('/addplot', function () {
    return view('AddPlot');
})->middleware('auth');

Route::get('/editplot/{id}', 'PlotsController@showeditplot')->middleware('auth');
Route::get('/contactown', function () {
    return view('ContactOwn');
})->middleware('auth');

Route::get('/adduser', function () {
    return view('AddUser');
})->middleware('auth');

Route::get('/userlog', function () {
    return view('UsersLog');
})->middleware('auth');

Route::get('/allusers', function () {
    $user = DB::table('users')->get();
    $cod = 0;
    return view('AllUsers', ['user' => $user])->with('cod', $cod);
})->middleware('auth');

Route::get('/allplots', function () {
    $cod = Auth::user()->id;
    if (Auth::check() && Auth::user()->role == '1' || Auth::check() && Auth::user()->role == '2') {
        $plots = DB::table('plots')->get();
    } else if (Auth::check() && Auth::user()->role == '3') {
        $plots = DB::select("SELECT * FROM plots INNER JOIN plot_user ON plots.id_plot =plot_user.id_plot WHERE plot_user.id_user = $cod");
    } else {

    }
    return view('AllPlots', ['plots' => $plots]);
})->middleware('auth');
Auth::routes();
    

