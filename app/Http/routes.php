<?php
use Illusminate\Http\Response;

use Illuminate\Http\Request;

use App\User as User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//home page
Route::get('/',['uses'=>'VideoController@index','as'=>'home']);
//post uploaded video
Route::post('storevideo',['uses'=>'VideoController@storeVideo','as'=>'storevideo']);
//post video frames
Route::post('storevideoframe',['uses'=>'VideoController@storeVideoframe','as'=>'storevideoframe']);
//get frame for each video
Route::get('/getframe/{id}',['uses'=>'VideoController@getFrame','as'=>'getframe']);