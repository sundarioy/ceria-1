<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DiscussionController;

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
Route::post('parent/login', [ParentsController::class, 'login']);

Route::post('teacher/store', [TeacherController::class, 'store']);
Route::get('teacher', [TeacherController::class, 'index']);
Route::get('teacher/{nik?}', [TeacherController::class, 'show']);
Route::post('teacher/update', [TeacherController::class, 'update']);
Route::delete('teacher/{nik?}', [TeacherController::class, 'destroy']);
Route::post('teacher/login', [TeacherController::class, 'login']);

Route::post('assignment/store', [AssignmentController::class, 'store']);
Route::get('assignment', [AssignmentController::class, 'index']);
Route::post('assignment/{id?}/update', [AssignmentController::class, 'update']);
Route::post('assignment/{id?}/delete', [AssignmentController::class, 'safeDelete']);
Route::get('nis/{nis?}/kelas/{id_kelas?}/assignment', [AssignmentController::class, 'getListParentAssignment']);
Route::get('nis/{nis?}/kelas/{id_kelas?}/assignment/{id_assignment?}', [AssignmentController::class, 'getParentDetailAssignment']);
Route::get('teacher/{nip?}/assignment/{id_assignment?}', [AssignmentController::class, 'getTeacherDetailAssignment']);
Route::get('teacher/{nip?}/listassignment', [AssignmentController::class, 'getTeacherListAssignment']);

Route::post('submission/store', [SubmissionController::class, 'store']);
Route::get('submission/{id_assignment?}/teacher/{nip?}/collected', [SubmissionController::class, 'getCollectSubmission']);
Route::post('submission/grade', [SubmissionController::class, 'gradingSubmission']);
Route::post('submission/grade/{id_grade}/update', [SubmissionController::class, 'updateGradeSubmission']);

Route::post('child/store', [ChildController::class, 'store']);
Route::get('child', [ChildController::class, 'index']);
Route::get('child/{id?}', [ChildController::class, 'show']);
Route::get('child/parent/{id?}', [ChildController::class, 'getChildByParentId']);
Route::post('child/update', [ChildController::class, 'update']);
Route::delete('child/{id?}', [ChildController::class, 'destroy']);

Route::post('kelas/store', [KelasController::class, 'store']);
Route::get('kelas', [KelasController::class, 'index']);
Route::get('kelas/{id?}', [KelasController::class, 'show']);
Route::post('kelas/update', [KelasController::class, 'update']);
Route::delete('kelas/{id?}', [KelasController::class, 'destroy']);

Route::post('discussion/store', [DiscussionController::class, 'store']);
Route::get('discussion/assignment/{id_assignment}/class/{id_class}', [DiscussionController::class, 'getDiscussion']);
Route::post('discussion/{id}/update', [DiscussionController::class, 'update']);
Route::delete('discussion/{id?}', [DiscussionController::class, 'destroy']);