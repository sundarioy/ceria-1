<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ChildController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('parent/store', [ParentsController::class, 'store']);
Route::get('parent', [ParentsController::class, 'index']);
Route::get('parent/{nik?}', [ParentsController::class, 'show']);
Route::post('parent/update', [ParentsController::class, 'update']);
Route::delete('parent/{nik?}', [ParentsController::class, 'destroy']);

Route::post('teacher/store', [TeacherController::class, 'store']);
Route::get('teacher', [TeacherController::class, 'index']);
Route::get('teacher/{nik?}', [TeacherController::class, 'show']);
Route::post('teacher/update', [TeacherController::class, 'update']);
Route::delete('teacher/{nik?}', [TeacherController::class, 'destroy']);

Route::post('assignment/store', [AssignmentController::class, 'store']);
Route::post('assignment/{id?}/update', [AssignmentController::class, 'update']);
Route::post('assignment/{id?}/delete', [AssignmentController::class, 'safeDelete']);
Route::get('nis/{nis?}/kelas/{id_kelas?}/assignment', [AssignmentController::class, 'listAssignment']);
Route::get('nis/{nis?}/kelas/{id_kelas?}/assignment/{id_assignment?}', [AssignmentController::class, 'getParentDetailAssignment']);
Route::get('teacher/{nip?}/assignment/{id_assignment?}', [AssignmentController::class, 'getTeacherDetailAssignment']);

Route::post('submission/store', [SubmissionController::class, 'store']);
Route::get('submission/{id_assignment?}/teacher/{nip?}/collected', [SubmissionController::class, 'getCollectSubmission']);

Route::post('child/store', [ChildController::class, 'store']);
Route::get('child', [ChildController::class, 'index']);
Route::get('child/{id?}', [ChildController::class, 'show']);
Route::post('child/update', [ChildController::class, 'update']);
Route::delete('child/{id?}', [ChildController::class, 'destroy']);