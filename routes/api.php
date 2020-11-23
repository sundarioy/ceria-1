<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignmentController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//AUTHENTICATION
// Route::post('/register', 'AuthController@register');
// Route::post('/login', 'AuthController@login');
// Route::get('/user', 'AuthController@user')->middleware('jwt.verify');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
// Route::get('book', 'BookController@book');

Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'

], function ($router) {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::get('user-profile', 'AuthController@userProfile');
});


// Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
Route::get('getUserProfile', 'AuthController@getAuthenticatedUser')->middleware('jwt.verify');


//ASSIGNMENTS
Route::get('/asmt', [AssignmentController::class, 'index']);
Route::post('/asmt/asmtCreate', 'AssignmentController@asmtCreate');
Route::post('/asmt/asmtSubmit', 'AssignmentController@asmtSubmit');
Route::get('/asmt/asmtShow/{id?}', 'AssignmentController@asmtShow');
Route::get('/asmt/asmtStudentSubms/{id?}', 'AssignmentController@asmtStudentSubms');


//ASSIGNMENTS AND SUBMISSIONS
Route::get('/asmt/asmtSubmission/{id?}', 'AssignmentController@asmtSubmission');
Route::post('/asmt/gradeSubmit/{id?}', 'AssignmentController@gradeSubmit');
// Route::post('asmt/asmtSubmission','AssignmentsController@asmtSubmit');