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

//вывод всех курсов с демовидео в блоке "Ознакомьтесь с нашими курсами"
Route::get('/getAllCourses', [\App\Http\Controllers\API\V1\CourseController::class,'getAll']);
//
//вывод курса по id
Route::get('/course/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'show']);
//
//вывод модуля с видео, тестами, заданиями на странице прохождения курса
Route::get('/module/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'moduleShow']);
//
//вывод курса со статистикой
Route::get('/fullCourse/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'CourseWithStat']);
//
//вывод всех учителей
Route::get('/getAllTeachers', [\App\Http\Controllers\API\V1\TeacherController::class,'getAll']);
//
//вывод всех тестов
Route::get('/getAllTests', [\App\Http\Controllers\API\V1\TestController::class,'getAll']);
//
//вывод тестов по id
Route::get('/getTest/{id}', [\App\Http\Controllers\API\V1\TestController::class,'show']);
//
//вывод избранного по id пользователя
Route::get('/getFavourite/{id}', [\App\Http\Controllers\API\V1\FavouriteController::class,'show']);
//
//вывод пользователь по id
Route::get('/getCabinet/{id}', [\App\Http\Controllers\API\V1\UserController::class,'show']);
//
//вывод всех русских слов словаря
Route::get('/getDictionaryWords/{dictionaryType}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getAll']);
//
//вывод перевода слова по типу словаря ru-lez,ru-avar,lez-ru,avar-ru и id слова
Route::get('/translate/{dictionaryType}/{id}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getTranslate']);
//
//вывод всех книг с их языком
Route::get('/getAllBooks', [\App\Http\Controllers\API\V1\ArtworkController::class,'getAll']);
//
//вывод книги по Id
Route::get('/book/{id}', [\App\Http\Controllers\API\V1\ArtworkController::class,'show']);
//







