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
use App\User;
Route::get('/', function () {
	//$user = \DB::collection('userCollection')->get();
	//$user = \DB::collection('userCollection')->where('name', 'Jonh Doe')->first();
	//$user =  App\User::all();
	//$user = App\User::where('age', '>', '35')->take(2)->get();
	//$user = App\User::where('age', '>', '35')->paginate(2);	
	//$user = User::whereIn('age', ['25', '35', '20'])->get();
	//$user = User::whereBetween('age', ['1', '40'])->get();
	//$user = User::whereNull('updated_at')->get();
	//$user = User::skip(10)->take(5)->orderBy('age', 'asc')->get();
	//$total = User::count();
	//$total = User::min('age');
	//$user = User::where('name', 'Jonh Doe')->increment('age');
	try {
		//\DB::collection('userCollection')->where('name', 'Jonh Doe')->push('items', 'boots');
		//\DB::collection('userCollection')->where('name', 'Jonh Doe')->push('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);
    	return User::all();		
	} catch(\MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
		return $e->getMessage();
	}
});

Route::get('mongo', 'MongoController@index');
Route::get('mongo/lists', 'MongoController@itemList');
Route::post('mongo/store', 'MongoController@store');
Route::put('mongo/{id}/update', 'MongoController@update');
Route::delete('mongo/{id}/destroy', 'MongoController@destroy');
