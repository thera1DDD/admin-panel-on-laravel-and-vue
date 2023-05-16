<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//вывод всех курсов с демовидео
Route::get('/getAllCourses', [\App\Http\Controllers\API\V1\CourseController::class,'getAll']);
//вывод курса по id
Route::get('/courses/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'show']);
//вывод всех учителей
Route::get('/getAllTeachers', [\App\Http\Controllers\API\V1\TeacherController::class,'getAll']);
//вывод всех тестов
Route::get('/getAllTests', [\App\Http\Controllers\API\V1\TestController::class,'getAll']);
//вывод тестов с вопросами
Route::get('/getTestWithQuestions/{id}', [\App\Http\Controllers\API\V1\TestController::class,'getWithQuestions']);



