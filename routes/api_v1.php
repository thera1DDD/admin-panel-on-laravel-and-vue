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
    //вывод курса по code
    Route::get('/{code}', [\App\Http\Controllers\API\V1\CourseController::class,'show']);
    //
    //вывод курса со статистикой на странице прохождения курса
    Route::get('/withProgress/{courseId}/{userId}/{code}', [\App\Http\Controllers\API\V1\CourseController::class,'courseWithProgress']);
    //
});

Route::group(['prefix' => 'module'], function (){
    //вывод модуля с видео, тестами, заданиями на странице прохождения курса
    Route::get('/{code}/{userId}', [\App\Http\Controllers\API\V1\CourseController::class,'moduleShow']);
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
    //получение теста по коду
    Route::get('/{code}', [\App\Http\Controllers\API\V1\TestController::class,'show']);
    //отправка результатов теста
    Route::post('/result/post',[\App\Http\Controllers\API\V1\TestController::class,'resultPost']);
});

Route::group(['prefix' => 'task'], function (){
//    //вывод всех тестов
//    Route::get('/all', [\App\Http\Controllers\API\V1\TestController::class,'getAll']);
//    //получение теста по коду
    Route::get('/{code}', [\App\Http\Controllers\API\V1\TaskController::class,'show']);
    Route::post('/result/post',[\App\Http\Controllers\API\V1\TaskController::class,'resultPost']);
});
Route::group(['prefix' => 'video'], function (){
//    //вывод всех тестов
//    Route::get('/all', [\App\Http\Controllers\API\V1\TestController::class,'getAll']);
//    //получение теста по коду
    Route::get('/{code}', [\App\Http\Controllers\API\V1\VideoController::class,'show']);
});

Route::group(['prefix' => 'favourite'], function (){
    //вывод избранного по id пользователя
    Route::get('/{id}', [\App\Http\Controllers\API\V1\FavouriteController::class,'show']);
    //
});
Route::group(['prefix' => 'dictionary'], function (){
    //вывод всех слов по типу словаря ru-lez,ru-avar,lez-ru,avar-ru
    Route::get('/all/{dictionaryType}/{language}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getAll']);
    //
    //поиск по словам
    Route::get('/search/{dictionaryType}/{languages_id}/{word}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getSearch']);
    //
//    //вывод перевода слова по типу словаря ru-lez,ru-avar,lez-ru,avar-ru и id слова
//    Route::get('/translate/{dictionaryType}/{languages_id}/{id}', [\App\Http\Controllers\API\V1\DictionaryController::class,'getTranslate']);
//    //
    Route::get('switch/all',[\App\Http\Controllers\API\V1\DictionaryController::class,'getSwithes']);
});

Route::group(['prefix' => 'artwork'], function (){
    //вывод всех книг с их языком
    Route::get('/all', [\App\Http\Controllers\API\V1\ArtworkController::class,'getAll']);
    //
    Route::get('/{id}', [\App\Http\Controllers\API\V1\ArtworkController::class,'show']);
    //
    Route::get('/type/{type}', [\App\Http\Controllers\API\V1\ArtworkController::class,'getAllByType']);
    //вывод книги по Id
    //
});
Route::group(['prefix' => 'stat'], function (){
    Route::post('/postStat', [\App\Http\Controllers\API\V1\StatController::class,'postStat']);
    //
});

Route::group(['prefix' => 'popularQuestions'], function (){
    Route::get('/all', [\App\Http\Controllers\API\V1\PopularQuestionController::class,'getAll']);
});

Route::group(['prefix' => 'category'], function (){
    Route::get('/all/{location}', [\App\Http\Controllers\API\V1\CategoryController::class,'getAll']);
});

Route::group(['prefix' => 'register'], function (){
    Route::post('/post', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'register']);
    Route::post('/verify/post', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'verifyCode']);
    Route::get('/survey/all', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'getSurvey']);
});

Route::group(['prefix' => 'auth'], function (){
    Route::post('/post', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'authenticate']);
});

Route::group(['prefix' => 'reset'], function (){
    Route::post('/send', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'passwordResetSend']);
    Route::post('/check', [\App\Http\Controllers\API\V1\Auth\RegisterController::class,'passwordResetCheck']);
});


Route::group(['prefix' => 'cabinet'], function (){
    Route::post('/update', [\App\Http\Controllers\API\V1\CabinetController::class,'update']);
    Route::get('/user/{id}', [\App\Http\Controllers\API\V1\CabinetController::class,'show']);
});


Route::group(['prefix' => 'reviews'], function (){
    Route::get('/all', [\App\Http\Controllers\API\V1\ReviewsController::class,'getAll']);
    Route::get('/user/{id}', [\App\Http\Controllers\API\V1\CabinetController::class,'show']);
});

Route::group(['prefix' => 'feedback'], function (){
    Route::post('/post', [\App\Http\Controllers\API\V1\FeedbackController::class,'postFeedback']);
//    Route::get('/user/{id}', [\App\Http\Controllers\API\V1\CabinetController::class,'show']);
});













