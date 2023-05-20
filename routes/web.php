    <?php

    use Composer\Util\Http\Response;
    use Facade\FlareClient\Stacktrace\File;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');



    Route::get('/profile', 'UserController@profile')->name('user.profile');

    Route::post('/profile', 'UserController@postProfile')->name('user.postProfile');

    Route::get('/password/change', 'UserController@getPassword')->name('userGetPassword');

    Route::post('/password/change', 'UserController@postPassword')->name('userPostPassword');
});

    Route::group(['prefix' => 'language'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\LanguageController::class, 'index'])->name('language.index');
        Route::get('/create',[\App\Http\Controllers\Admin\LanguageController::class, 'create'])->name('language.create');
        Route::post('/',[\App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('language.store');
        Route::get('/{language}/edit',[\App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('language.edit');
        Route::patch('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('language.update');
        Route::delete('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'delete'])->name('language.delete');
    });

    Route::group(['prefix' => 'course'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('course.index');
        Route::get('/create',[\App\Http\Controllers\Admin\CourseController::class, 'create'])->name('course.create');
        Route::post('/',[\App\Http\Controllers\Admin\CourseController::class, 'store'])->name('course.store');
        Route::get('/{course}/edit',[\App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('course.edit');
        Route::patch('{course}',[\App\Http\Controllers\Admin\CourseController::class, 'update'])->name('course.update');
        Route::delete('{course}',[\App\Http\Controllers\Admin\CourseController::class, 'delete'])->name('course.delete');
        Route::get('/{course}',[\App\Http\Controllers\Admin\CourseController::class, 'play'])->name('course.play');
    });

    Route::group(['prefix' => 'module'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\ModuleController::class, 'index'])->name('module.index');
        Route::get('/create',[\App\Http\Controllers\Admin\ModuleController::class, 'create'])->name('module.create');
        Route::post('/',[\App\Http\Controllers\Admin\ModuleController::class, 'store'])->name('module.store');
        Route::get('/{module}/edit',[\App\Http\Controllers\Admin\ModuleController::class, 'edit'])->name('module.edit');
        Route::patch('{module}',[\App\Http\Controllers\Admin\ModuleController::class, 'update'])->name('module.update');
        Route::delete('{module}',[\App\Http\Controllers\Admin\ModuleController::class, 'delete'])->name('module.delete');
    });

    Route::group(['prefix' => 'video'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('video.index');
        Route::get('/create',[\App\Http\Controllers\Admin\VideoController::class, 'create'])->name('video.create');
        Route::post('/',[\App\Http\Controllers\Admin\VideoController::class, 'store'])->name('video.store');
        Route::get('/{video}/edit',[\App\Http\Controllers\Admin\VideoController::class, 'edit'])->name('video.edit');
        Route::patch('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'update'])->name('video.update');
        Route::delete('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'delete'])->name('video.delete');
        Route::get('/{video}',[\App\Http\Controllers\Admin\VideoController::class, 'play'])->name('video.play');
    });

    Route::group(['prefix' => 'demovideo'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\DemovideoController::class, 'index'])->name('demovideo.index');
        Route::get('/create',[\App\Http\Controllers\Admin\DemovideoController::class, 'create'])->name('demovideo.create');
        Route::post('/',[\App\Http\Controllers\Admin\DemovideoController::class, 'store'])->name('demovideo.store');
        Route::get('/{demovideo}/edit',[\App\Http\Controllers\Admin\DemovideoController::class, 'edit'])->name('demovideo.edit');
        Route::patch('{demovideo}',[\App\Http\Controllers\Admin\DemovideoController::class, 'update'])->name('demovideo.update');
        Route::delete('{demovideo}',[\App\Http\Controllers\Admin\DemovideoController::class, 'delete'])->name('demovideo.delete');
        Route::get('/{demovideo}',[\App\Http\Controllers\Admin\DemovideoController::class, 'play'])->name('demovideo.play');
    });

    Route::group(['prefix' => 'test'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\TestController::class, 'index'])->name('test.index');
        Route::get('/create',[\App\Http\Controllers\Admin\TestController::class, 'create'])->name('test.create');
        Route::post('/',[\App\Http\Controllers\Admin\TestController::class, 'store'])->name('test.store');
        Route::get('/{test}/edit',[\App\Http\Controllers\Admin\TestController::class, 'edit'])->name('test.edit');
        Route::patch('{test}',[\App\Http\Controllers\Admin\TestController::class, 'update'])->name('test.update');
        Route::delete('{test}',[\App\Http\Controllers\Admin\TestController::class, 'delete'])->name('test.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\TestController::class, 'show'])->name('test.show');
        Route::get('/models/{model}/records', [\App\Http\Controllers\Admin\TestController::class, 'getRecordsByType'])->name('records.by.type');
    });

    Route::group(['prefix' => 'question'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('question.index');
        Route::get('{id}/create',[\App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('question.create');
        Route::post('/',[\App\Http\Controllers\Admin\QuestionController::class, 'store'])->name('question.store');
        Route::get('/{question}/edit',[\App\Http\Controllers\Admin\QuestionController::class, 'edit'])->name('question.edit');
        Route::patch('{question}',[\App\Http\Controllers\Admin\QuestionController::class, 'update'])->name('question.update');
        Route::delete('{question}',[\App\Http\Controllers\Admin\QuestionController::class, 'delete'])->name('question.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\QuestionController::class, 'show'])->name('question.show');
    });

    Route::group(['prefix' => 'answer'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\AnswerController::class, 'index'])->name('answer.index');
        Route::get('{id}/create',[\App\Http\Controllers\Admin\AnswerController::class, 'create'])->name('answer.create');
        Route::post('/',[\App\Http\Controllers\Admin\AnswerController::class, 'store'])->name('answer.store');
        Route::get('/{answer}/edit',[\App\Http\Controllers\Admin\AnswerController::class, 'edit'])->name('answer.edit');
        Route::patch('{answer}',[\App\Http\Controllers\Admin\AnswerController::class, 'update'])->name('answer.update');
        Route::delete('{answer}',[\App\Http\Controllers\Admin\AnswerController::class, 'delete'])->name('answer.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\AnswerController::class, 'show'])->name('answer.show');
    });

    Route::group(['prefix' => 'comment'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comment.index');
        Route::get('/create',[\App\Http\Controllers\Admin\CommentController::class, 'create'])->name('comment.create');
        Route::post('/',[\App\Http\Controllers\Admin\CommentController::class, 'store'])->name('comment.store');
        Route::get('/{comment}/edit',[\App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('comment.edit');
        Route::patch('{comment}',[\App\Http\Controllers\Admin\CommentController::class, 'update'])->name('comment.update');
        Route::delete('{comment}',[\App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('comment.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\CommentController::class, 'show'])->name('comment.show');
        Route::get('/comments/{comment}/records', [\App\Http\Controllers\Admin\CommentController::class, 'getRecordsByType'])->name('records.by.type');
    });

    Route::group(['prefix' => 'photo'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\PhotoController::class, 'index'])->name('photo.index');
        Route::get('/create',[\App\Http\Controllers\Admin\PhotoController::class, 'create'])->name('photo.create');
        Route::post('/',[\App\Http\Controllers\Admin\PhotoController::class, 'store'])->name('photo.store');
        Route::get('/{photo}/edit',[\App\Http\Controllers\Admin\PhotoController::class, 'edit'])->name('photo.edit');
        Route::patch('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'update'])->name('photo.update');
        Route::delete('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'delete'])->name('photo.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\PhotoController::class, 'show'])->name('photo.show');
        Route::get('/photos/{photo}/records', [\App\Http\Controllers\Admin\PhotoController::class, 'getRecordsByType'])->name('records.by.type');

    });

    Route::group(['prefix' => 'word'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\WordController::class, 'index'])->name('word.index');
        Route::get('/create',[\App\Http\Controllers\Admin\WordController::class, 'create'])->name('word.create');
        Route::post('/',[\App\Http\Controllers\Admin\WordController::class, 'store'])->name('word.store');
        Route::get('/{word}/edit',[\App\Http\Controllers\Admin\WordController::class, 'edit'])->name('word.edit');
        Route::patch('{word}',[\App\Http\Controllers\Admin\WordController::class, 'update'])->name('word.update');
        Route::delete('{word}',[\App\Http\Controllers\Admin\WordController::class, 'delete'])->name('word.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\WordController::class, 'show'])->name('word.show');
        Route::get('/search',[\App\Http\Controllers\Admin\WordController::class, 'search'])->name('word.search');

    });

    Route::group(['prefix' => 'translate'], function (){
        Route::get('{id}',[\App\Http\Controllers\Admin\TranslateController::class, 'index'])->name('translate.index');
        Route::get('{id}/create',[\App\Http\Controllers\Admin\TranslateController::class, 'create'])->name('translate.create');
        Route::post('/',[\App\Http\Controllers\Admin\TranslateController::class, 'store'])->name('translate.store');
        Route::get('/{translate}/edit',[\App\Http\Controllers\Admin\TranslateController::class, 'edit'])->name('translate.edit');
        Route::patch('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'update'])->name('translate.update');
        Route::delete('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'delete'])->name('translate.delete');
    });

    Route::group(['prefix' => 'favourite'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\FavouritesController::class, 'index'])->name('favourite.index');
        Route::get('/create',[\App\Http\Controllers\Admin\FavouritesController::class, 'create'])->name('favourite.create');
        Route::post('/',[\App\Http\Controllers\Admin\FavouritesController::class, 'store'])->name('favourite.store');
        Route::get('/{favourite}/edit',[\App\Http\Controllers\Admin\FavouritesController::class, 'edit'])->name('favourite.edit');
        Route::patch('{favourite}',[\App\Http\Controllers\Admin\FavouritesController::class, 'update'])->name('favourite.update');
        Route::delete('{favourite}',[\App\Http\Controllers\Admin\FavouritesController::class, 'delete'])->name('favourite.delete');
    });


    Route::group(['prefix' => 'stat'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\StatController::class, 'index'])->name('stat.index');
        Route::get('/create',[\App\Http\Controllers\Admin\StatController::class, 'create'])->name('stat.create');
        Route::post('/',[\App\Http\Controllers\Admin\StatController::class, 'store'])->name('stat.store');
        Route::get('/{stat}/edit',[\App\Http\Controllers\Admin\StatController::class, 'edit'])->name('stat.edit');
        Route::patch('{stat}',[\App\Http\Controllers\Admin\StatController::class, 'update'])->name('stat.update');
        Route::delete('{stat}',[\App\Http\Controllers\Admin\StatController::class, 'delete'])->name('stat.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\StatController::class, 'show'])->name('stat.show');
    });

    Route::group(['prefix' => 'task'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\TaskController::class, 'index'])->name('task.index');
        Route::get('/create',[\App\Http\Controllers\Admin\TaskController::class, 'create'])->name('task.create');
        Route::post('/',[\App\Http\Controllers\Admin\TaskController::class, 'store'])->name('task.store');
        Route::get('/{task}/edit',[\App\Http\Controllers\Admin\TaskController::class, 'edit'])->name('task.edit');
        Route::patch('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'update'])->name('task.update');
        Route::delete('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'delete'])->name('task.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\TaskController::class, 'show'])->name('task.show');
    });

    Route::group(['prefix' => 'upgrade'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\UpgradeController::class, 'index'])->name('upgrade.index');
        Route::get('/create',[\App\Http\Controllers\Admin\UpgradeController::class, 'create'])->name('upgrade.create');
        Route::post('/',[\App\Http\Controllers\Admin\UpgradeController::class, 'store'])->name('upgrade.store');
        Route::get('/{upgrade}/edit',[\App\Http\Controllers\Admin\UpgradeController::class, 'edit'])->name('upgrade.edit');
        Route::patch('{upgrade}',[\App\Http\Controllers\Admin\UpgradeController::class, 'update'])->name('upgrade.update');
        Route::delete('{upgrade}',[\App\Http\Controllers\Admin\UpgradeController::class, 'delete'])->name('upgrade.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\UpgradeController::class, 'show'])->name('upgrade.show');
    });


    Route::group(['prefix' => 'log'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\LogController::class, 'index'])->name('log.index');
        Route::get('/create',[\App\Http\Controllers\Admin\LogController::class, 'create'])->name('log.create');
        Route::post('/',[\App\Http\Controllers\Admin\LogController::class, 'store'])->name('log.store');
        Route::get('/{log}/edit',[\App\Http\Controllers\Admin\LogController::class, 'edit'])->name('log.edit');
        Route::patch('{log}',[\App\Http\Controllers\Admin\LogController::class, 'update'])->name('log.update');
        Route::delete('{log}',[\App\Http\Controllers\Admin\LogController::class, 'delete'])->name('log.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\LogController::class, 'show'])->name('log.show');
    });

    Route::group(['prefix' => 'teacher'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('teacher.index');
        Route::get('/create',[\App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/',[\App\Http\Controllers\Admin\TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/{teacher}/edit',[\App\Http\Controllers\Admin\TeacherController::class, 'edit'])->name('teacher.edit');
        Route::patch('{teacher}',[\App\Http\Controllers\Admin\TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('{teacher}',[\App\Http\Controllers\Admin\TeacherController::class, 'delete'])->name('teacher.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\TeacherController::class, 'show'])->name('teacher.show');
    });

    Route::group(['prefix' => 'artwork'], function (){
        Route::get('/',[\App\Http\Controllers\Admin\ArtworkController::class, 'index'])->name('artwork.index');
        Route::get('/create',[\App\Http\Controllers\Admin\ArtworkController::class, 'create'])->name('artwork.create');
        Route::post('/',[\App\Http\Controllers\Admin\ArtworkController::class, 'store'])->name('artwork.store');
        Route::get('/{artwork}/edit',[\App\Http\Controllers\Admin\ArtworkController::class, 'edit'])->name('artwork.edit');
        Route::patch('{artwork}',[\App\Http\Controllers\Admin\ArtworkController::class, 'update'])->name('artwork.update');
        Route::delete('{artwork}',[\App\Http\Controllers\Admin\ArtworkController::class, 'delete'])->name('artwork.delete');
        Route::get('/{id}',[\App\Http\Controllers\Admin\ArtworkController::class, 'show'])->name('artwork.show');
    });





    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');

Route::group(['middleware' => ['auth', 'role_or_permission:admin|create role|create permission']], function() {



});


Auth::routes();
//////////////////////////////// axios request for user

Route::get('/getAllPermission', 'PermissionController@getAllPermissions');
Route::post("/postRole", "RoleController@store");
Route::get("/getAllUsers", "UserController@getAll");
Route::get("/getAllRoles", "RoleController@getAll");
Route::get("/getAllPermissions", "PermissionController@getAll");

/////////////axios create user
Route::post('/account/create', 'UserController@store');
Route::put('/account/update/{id}', 'UserController@update');
Route::delete('/delete/user/{id}', 'UserController@delete');
Route::get('/search/user', 'UserController@search');
