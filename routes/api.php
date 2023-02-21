<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\MsgController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(MsgController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/msg','allmsg');
    Route::post('/msg', 'sendmsg')->name('sendmsg')->middleware('prevent-duplicate');
});

 

/*
Route::get('/users', function () {

    User::updateOrCreate([
       'email' => 'johndoe@gmail.com'
   ],[
       'name' => 'Johnny Doe',
       'email' => 'johndoe@gmail.com',
       'password' => bcrypt('1111')
   ]); 


   $users = User::all();

   return $users;
});*/
