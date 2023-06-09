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


Route::group(['prefix' => 'course'], function (){
    //вывод всех курсов
    Route::get('/all', [\App\Http\Controllers\API\V1\CourseController::class,'getAll']);
    //
    //вывод курса по id
    Route::get('/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'show']);
    //
    //вывод курса со статистикой на странице прохождения курса
    Route::get('/withProgress/{courseId}/{userId}', [\App\Http\Controllers\API\V1\CourseController::class,'courseWithProgress']);
    //
});

Route::group(['prefix' => 'module'], function (){
    //вывод модуля с видео, тестами, заданиями на странице прохождения курса
    Route::get('/{id}', [\App\Http\Controllers\API\V1\CourseController::class,'moduleShow']);
    //
});
Route::group(['prefix' => 'teacher'], function (){
    //вывод всех учителей
    Route::get('/all', [\App\Http\Controllers\API\V1\TeacherController::class,'getAll']);
    //
});
Route::group(['prefix' => 'test'], function (){
    //вывод всех тестов
    Route::get('/all', [\App\Http\Controllers\API\V1\TestController::class,'getAll']);
    //
    Route::get('/{id}', [\App\Http\Controllers\API\V1\TestController::class,'show']);
});

Route::group(['prefix' => 'favourite'], function (){
    //вывод всего избранного по id пользователя
    Route::get('/getCabinet/{id}', [\App\Http\Controllers\API\V1\FavouriteController::class,'show']);
    //
    //вывод только данных пользователя по id
    Route::get('/{id}', [\App\Http\Controllers\API\V1\UserController::class,'show']);
    //
});
Route::group(['prefix' => 'dictionary'], function (){
    //вывод всех слов по типу словаря ru-lez,ru-avar,lez-ru,avar-ru
    Route::get('/all/{dictionaryType}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getAll']);
    //
    //поиск по словам
    Route::get('/search/{dictionaryType}/{word}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getSearch']);
    //
    //вывод перевода слова по типу словаря ru-lez,ru-avar,lez-ru,avar-ru и id слова
    Route::get('/translate/{dictionaryType}/{id}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getTranslate']);
    //
    Route::get('switch/all',[\App\Http\Controllers\API\V1\DictionaryController::class,'getSwithes']);
});

Route::group(['prefix' => 'book'], function (){
    //вывод всех книг с их языком
    Route::get('/all', [\App\Http\Controllers\API\V1\ArtworkController::class,'getAll']);
    //
    //вывод книги по Id
    Route::get('/book/{id}', [\App\Http\Controllers\API\V1\ArtworkController::class,'show']);
    //
});
Route::group(['prefix' => 'stat'], function (){
    //отметка пройденного материала(отметка зеленным)
    //принимает   'passed_courses_id' => 'nullable|integer',
    //            'passed_modules_id' => 'nullable',
    //            'passed_videos_id' => 'nullable',
    //            'users_id' => 'nullable',
    Route::post('/postStat', [\App\Http\Controllers\API\V1\StatController::class,'postStat']);
    //
});

Route::group(['prefix' => 'popularQuestions'], function (){
    Route::get('/all', [\App\Http\Controllers\API\V1\PopularQuestionController::class,'getAll']);
});

Route::group(['prefix' => 'category'], function (){
    Route::get('/all/{location}', [\App\Http\Controllers\API\V1\CategoryController::class,'getAll']);
});

Route::group(['prefix' => 'reg'], function (){
    //отметка пройденного материала(отметка зеленным)
    //принимает   'passed_courses_id' => 'nullable|integer',
    //            'passed_modules_id' => 'nullable',
    //            'passed_videos_id' => 'nullable',
    //            'users_id' => 'nullable',
    Route::post('/post', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'register']);
    //
});











