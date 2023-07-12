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
        return view('home');
    });
Route::group(['middleware' => 'auth'], function() {
    Route::get('/403', [\App\Http\Controllers\Admin\HomeController::class, 'errorPage'])->name('403Page');
    Route::group(['middleware' => 'admin'], function() {

        Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

        Route::get('/profile', 'UserController@profile')->name('user.profile');

        Route::post('/profile', 'UserController@postProfile')->name('user.postProfile');

        Route::get('/password/change', 'UserController@getPassword')->name('userGetPassword');

        Route::post('/password/change', 'UserController@postPassword')->name('userPostPassword');
        Route::group(['prefix' => 'word'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\WordController::class, 'index'])->name('word.index');
            Route::get('/create',[\App\Http\Controllers\Admin\WordController::class, 'create'])->name('word.create');
            Route::post('/',[\App\Http\Controllers\Admin\WordController::class, 'store'])->name('word.store');
            Route::get('/{word}/edit',[\App\Http\Controllers\Admin\WordController::class, 'edit'])->name('word.edit');
            Route::patch('{word}',[\App\Http\Controllers\Admin\WordController::class, 'update'])->name('word.update');
            Route::delete('{word}',[\App\Http\Controllers\Admin\WordController::class, 'delete'])->name('word.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\WordController::class, 'show'])->name('word.show');
            Route::get('/search',[\App\Http\Controllers\Admin\WordController::class, 'search'])->name('word.search');
            Route::post('/import',[\App\Http\Controllers\Admin\WordController::class, 'import'])->name('word.import');

        });

        Route::group(['prefix' => 'translate'], function (){
            Route::get('{id}',[\App\Http\Controllers\Admin\TranslateController::class, 'index'])->name('translate.index');
            Route::get('{id}/create',[\App\Http\Controllers\Admin\TranslateController::class, 'create'])->name('translate.create');
            Route::post('/',[\App\Http\Controllers\Admin\TranslateController::class, 'store'])->name('translate.store');
            Route::get('/{translate}/edit',[\App\Http\Controllers\Admin\TranslateController::class, 'edit'])->name('translate.edit');
            Route::patch('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'update'])->name('translate.update');
            Route::delete('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'delete'])->name('translate.delete');
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


        Route::group(['prefix' => 'task'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\TaskController::class, 'index'])->name('task.index');
            Route::get('/create',[\App\Http\Controllers\Admin\TaskController::class, 'create'])->name('task.create');
            Route::post('/',[\App\Http\Controllers\Admin\TaskController::class, 'store'])->name('task.store');
            Route::get('/{task}/edit',[\App\Http\Controllers\Admin\TaskController::class, 'edit'])->name('task.edit');
            Route::patch('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'update'])->name('task.update');
            Route::delete('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'delete'])->name('task.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\TaskController::class, 'show'])->name('task.show');
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




        Route::group(['prefix' => 'video'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('video.index');
            Route::get('/create',[\App\Http\Controllers\Admin\VideoController::class, 'create'])->name('video.create');
            Route::post('/',[\App\Http\Controllers\Admin\VideoController::class, 'store'])->name('video.store');
            Route::get('/{video}/edit',[\App\Http\Controllers\Admin\VideoController::class, 'edit'])->name('video.edit');
            Route::patch('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'update'])->name('video.update');
            Route::delete('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'delete'])->name('video.delete');
            Route::get('/{video}',[\App\Http\Controllers\Admin\VideoController::class, 'play'])->name('video.play');
        });




        //other stuff
        Route::group(['prefix' => 'language'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\LanguageController::class, 'index'])->name('language.index');
            Route::get('/create',[\App\Http\Controllers\Admin\LanguageController::class, 'create'])->name('language.create');
            Route::post('/',[\App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('language.store');
            Route::get('/{language}/edit',[\App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('language.edit');
            Route::patch('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('language.update');
            Route::delete('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'delete'])->name('language.delete');
        });


        Route::group(['prefix' => 'comment'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comment.index');
            Route::get('/create',[\App\Http\Controllers\Admin\CommentController::class, 'create'])->name('comment.create');
            Route::post('/',[\App\Http\Controllers\Admin\CommentController::class, 'store'])->name('comment.store');
            Route::get('/{comment}/edit',[\App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('comment.edit');
            Route::patch('{comment}',[\App\Http\Controllers\Admin\CommentController::class, 'update'])->name('comment.update');
            Route::delete('{comment}',[\App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('comment.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\CommentController::class, 'show'])->name('comment.show');
            Route::get('/comments/{comment}/records', [\App\Http\Controllers\Admin\CommentController::class, 'getRecordsByType'])->name('commentRecords.by.type');
        });

        Route::group(['prefix' => 'photo'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\PhotoController::class, 'index'])->name('photo.index');
            Route::get('/create',[\App\Http\Controllers\Admin\PhotoController::class, 'create'])->name('photo.create');
            Route::post('/',[\App\Http\Controllers\Admin\PhotoController::class, 'store'])->name('photo.store');
            Route::get('/{photo}/edit',[\App\Http\Controllers\Admin\PhotoController::class, 'edit'])->name('photo.edit');
            Route::patch('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'update'])->name('photo.update');
            Route::delete('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'delete'])->name('photo.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\PhotoController::class, 'show'])->name('photo.show');
            Route::get('/photos/{photo}/records', [\App\Http\Controllers\Admin\PhotoController::class, 'getRecordsByType'])->name('photoRecords.by.type');

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



        Route::group(['prefix' => 'popularQuestion'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'index'])->name('popularQuestion.index');
            Route::get('/create',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'create'])->name('popularQuestion.create');
            Route::post('/',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'store'])->name('popularQuestion.store');
            Route::get('/{popularQuestion}/edit',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'edit'])->name('popularQuestion.edit');
            Route::patch('{popularQuestion}',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'update'])->name('popularQuestion.update');
            Route::delete('{popularQuestion}',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'delete'])->name('popularQuestion.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\PopularQuestionController::class, 'show'])->name('popularQuestion.show');
        });
        Route::group(['prefix' => 'category'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
            Route::get('/create',[\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
            Route::post('/',[\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
            Route::get('/{category}/edit',[\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
            Route::patch('{category}',[\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
            Route::delete('{category}',[\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('category.show');
        });

        Route::group(['prefix' => 'column'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\ColumnController::class, 'index'])->name('column.index');
            Route::get('/create',[\App\Http\Controllers\Admin\ColumnController::class, 'create'])->name('column.create');
            Route::post('/',[\App\Http\Controllers\Admin\ColumnController::class, 'store'])->name('column.store');
            Route::get('/{column}/edit',[\App\Http\Controllers\Admin\ColumnController::class, 'edit'])->name('column.edit');
            Route::patch('{column}',[\App\Http\Controllers\Admin\ColumnController::class, 'update'])->name('column.update');
            Route::delete('{column}',[\App\Http\Controllers\Admin\ColumnController::class, 'delete'])->name('column.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\ColumnController::class, 'show'])->name('column.show');
        });

        Route::group(['prefix' => 'switchLang'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\SwitchController::class, 'index'])->name('switchLang.index');
            Route::get('/create',[\App\Http\Controllers\Admin\SwitchController::class, 'create'])->name('switchLang.create');
            Route::post('/',[\App\Http\Controllers\Admin\SwitchController::class, 'store'])->name('switchLang.store');
            Route::get('/{switchLang}/edit',[\App\Http\Controllers\Admin\SwitchController::class, 'edit'])->name('switchLang.edit');
            Route::patch('{switchLang}',[\App\Http\Controllers\Admin\SwitchController::class, 'update'])->name('switchLang.update');
            Route::delete('{switchLang}',[\App\Http\Controllers\Admin\SwitchController::class, 'delete'])->name('switchLang.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\SwitchController::class, 'show'])->name('switchLang.show');
        });

        Route::group(['prefix' => 'testsResult'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\TestResultController::class, 'index'])->name('testsResult.index');
            Route::get('/create',[\App\Http\Controllers\Admin\TestResultController::class, 'create'])->name('testsResult.create');
            Route::post('/',[\App\Http\Controllers\Admin\TestResultController::class, 'store'])->name('testsResult.store');
            Route::get('/{testsResult}/edit',[\App\Http\Controllers\Admin\TestResultController::class, 'edit'])->name('testsResult.edit');
            Route::patch('{testsResult}',[\App\Http\Controllers\Admin\TestResultController::class, 'update'])->name('testsResult.update');
            Route::delete('{testsResult}',[\App\Http\Controllers\Admin\TestResultController::class, 'delete'])->name('testsResult.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\TestResultController::class, 'show'])->name('testsResult.show');
        });
        Route::group(['prefix' => 'users'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
            Route::get('/create',[\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
            Route::post('/',[\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
            Route::get('/{user}/edit',[\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
            Route::patch('{user}',[\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
            Route::delete('{user}',[\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        });





        Route::resource('user', 'UserController');
        Route::resource('permission', 'PermissionController');
        Route::resource('role', 'RoleController');

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


        Route::group(['prefix' => 'surveyQuestion'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'index'])->name('surveyQuestion.index');
            Route::get('/create',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'create'])->name('surveyQuestion.create');
            Route::post('/',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'store'])->name('surveyQuestion.store');
            Route::get('/{surveyQuestion}/edit',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'edit'])->name('surveyQuestion.edit');
            Route::patch('{surveyQuestion}',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'update'])->name('surveyQuestion.update');
            Route::delete('{surveyQuestion}',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'delete'])->name('surveyQuestion.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\SurveyQuestionController::class, 'show'])->name('surveyQuestion.show');
        });

        Route::group(['prefix' => 'surveyAnswer'], function (){
            Route::get('{id}/create',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'create'])->name('surveyAnswer.create');
            Route::post('/',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'store'])->name('surveyAnswer.store');
            Route::get('/{surveyAnswer}/edit',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'edit'])->name('surveyAnswer.edit');
            Route::patch('{surveyAnswer}',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'update'])->name('surveyAnswer.update');
            Route::delete('{surveyAnswer}',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'delete'])->name('surveyAnswer.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\SurveyAnswersController::class, 'show'])->name('surveyAnswer.show');
        });

        Route::group(['prefix' => 'surveyResult'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\SurveyResultController::class, 'index'])->name('surveyResult.index');
            Route::get('/create',[\App\Http\Controllers\Admin\SurveyResultController::class, 'create'])->name('surveyResult.create');
            Route::post('/',[\App\Http\Controllers\Admin\SurveyResultController::class, 'store'])->name('surveyResult.store');
            Route::get('/{surveyResult}/edit',[\App\Http\Controllers\Admin\SurveyResultController::class, 'edit'])->name('surveyResult.edit');
            Route::patch('{surveyResult}',[\App\Http\Controllers\Admin\SurveyResultController::class, 'update'])->name('surveyResult.update');
            Route::delete('{id}',[\App\Http\Controllers\Admin\SurveyResultController::class, 'delete'])->name('surveyResult.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\SurveyResultController::class, 'show'])->name('surveyResult.show');
        });

        Route::group(['prefix' => 'tasksResult'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\TaskResultController::class, 'index'])->name('tasksResult.index');
            Route::get('/create',[\App\Http\Controllers\Admin\TaskResultController::class, 'create'])->name('tasksResult.create');
            Route::post('/',[\App\Http\Controllers\Admin\TaskResultController::class, 'store'])->name('tasksResult.store');
            Route::get('/{tasksResult}/edit',[\App\Http\Controllers\Admin\TaskResultController::class, 'edit'])->name('tasksResult.edit');
            Route::patch('{tasksResult}',[\App\Http\Controllers\Admin\TaskResultController::class, 'update'])->name('tasksResult.update');
            Route::delete('{tasksResult}',[\App\Http\Controllers\Admin\TaskResultController::class, 'delete'])->name('tasksResult.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\TaskResultController::class, 'show'])->name('tasksResult.show');
        });
    });
//moder stuff


    Route::group(['middleware' => 'moderator'], function() {

        Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

        Route::get('/profile', 'UserController@profile')->name('user.profile');

        Route::post('/profile', 'UserController@postProfile')->name('user.postProfile');

        Route::get('/password/change', 'UserController@getPassword')->name('userGetPassword');

        Route::post('/password/change', 'UserController@postPassword')->name('userPostPassword');
        Route::group(['prefix' => 'word'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\WordController::class, 'index'])->name('word.index');
            Route::get('/create',[\App\Http\Controllers\Admin\WordController::class, 'create'])->name('word.create');
            Route::post('/',[\App\Http\Controllers\Admin\WordController::class, 'store'])->name('word.store');
            Route::get('/{word}/edit',[\App\Http\Controllers\Admin\WordController::class, 'edit'])->name('word.edit');
            Route::patch('{word}',[\App\Http\Controllers\Admin\WordController::class, 'update'])->name('word.update');
            Route::delete('{word}',[\App\Http\Controllers\Admin\WordController::class, 'delete'])->name('word.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\WordController::class, 'show'])->name('word.show');
            Route::get('/search',[\App\Http\Controllers\Admin\WordController::class, 'search'])->name('word.search');
            Route::post('/import',[\App\Http\Controllers\Admin\WordController::class, 'import'])->name('word.import');

        });

        Route::group(['prefix' => 'translate'], function (){
            Route::get('{id}',[\App\Http\Controllers\Admin\TranslateController::class, 'index'])->name('translate.index');
            Route::get('{id}/create',[\App\Http\Controllers\Admin\TranslateController::class, 'create'])->name('translate.create');
            Route::post('/',[\App\Http\Controllers\Admin\TranslateController::class, 'store'])->name('translate.store');
            Route::get('/{translate}/edit',[\App\Http\Controllers\Admin\TranslateController::class, 'edit'])->name('translate.edit');
            Route::patch('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'update'])->name('translate.update');
            Route::delete('{translate}',[\App\Http\Controllers\Admin\TranslateController::class, 'delete'])->name('translate.delete');
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


        Route::group(['prefix' => 'task'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\TaskController::class, 'index'])->name('task.index');
            Route::get('/create',[\App\Http\Controllers\Admin\TaskController::class, 'create'])->name('task.create');
            Route::post('/',[\App\Http\Controllers\Admin\TaskController::class, 'store'])->name('task.store');
            Route::get('/{task}/edit',[\App\Http\Controllers\Admin\TaskController::class, 'edit'])->name('task.edit');
            Route::patch('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'update'])->name('task.update');
            Route::delete('{task}',[\App\Http\Controllers\Admin\TaskController::class, 'delete'])->name('task.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\TaskController::class, 'show'])->name('task.show');
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




        Route::group(['prefix' => 'video'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('video.index');
            Route::get('/create',[\App\Http\Controllers\Admin\VideoController::class, 'create'])->name('video.create');
            Route::post('/',[\App\Http\Controllers\Admin\VideoController::class, 'store'])->name('video.store');
            Route::get('/{video}/edit',[\App\Http\Controllers\Admin\VideoController::class, 'edit'])->name('video.edit');
            Route::patch('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'update'])->name('video.update');
            Route::delete('{video}',[\App\Http\Controllers\Admin\VideoController::class, 'delete'])->name('video.delete');
            Route::get('/{video}',[\App\Http\Controllers\Admin\VideoController::class, 'play'])->name('video.play');
        });


        Route::group(['prefix' => 'switchLang'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\SwitchController::class, 'index'])->name('switchLang.index');
            Route::get('/create',[\App\Http\Controllers\Admin\SwitchController::class, 'create'])->name('switchLang.create');
            Route::post('/',[\App\Http\Controllers\Admin\SwitchController::class, 'store'])->name('switchLang.store');
            Route::get('/{switchLang}/edit',[\App\Http\Controllers\Admin\SwitchController::class, 'edit'])->name('switchLang.edit');
            Route::patch('{switchLang}',[\App\Http\Controllers\Admin\SwitchController::class, 'update'])->name('switchLang.update');
            Route::delete('{switchLang}',[\App\Http\Controllers\Admin\SwitchController::class, 'delete'])->name('switchLang.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\SwitchController::class, 'show'])->name('switchLang.show');
        });

        Route::group(['prefix' => 'testsResult'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\TestResultController::class, 'index'])->name('testsResult.index');
            Route::get('/create',[\App\Http\Controllers\Admin\TestResultController::class, 'create'])->name('testsResult.create');
            Route::post('/',[\App\Http\Controllers\Admin\TestResultController::class, 'store'])->name('testsResult.store');
            Route::get('/{testsResult}/edit',[\App\Http\Controllers\Admin\TestResultController::class, 'edit'])->name('testsResult.edit');
            Route::patch('{testsResult}',[\App\Http\Controllers\Admin\TestResultController::class, 'update'])->name('testsResult.update');
            Route::delete('{testsResult}',[\App\Http\Controllers\Admin\TestResultController::class, 'delete'])->name('testsResult.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\TestResultController::class, 'show'])->name('testsResult.show');
        });

        Route::group(['prefix' => 'language'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\LanguageController::class, 'index'])->name('language.index');
            Route::get('/create',[\App\Http\Controllers\Admin\LanguageController::class, 'create'])->name('language.create');
            Route::post('/',[\App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('language.store');
            Route::get('/{language}/edit',[\App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('language.edit');
            Route::patch('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('language.update');
            Route::delete('{language}',[\App\Http\Controllers\Admin\LanguageController::class, 'delete'])->name('language.delete');
        });


        Route::group(['prefix' => 'photo'], function (){
            Route::get('/',[\App\Http\Controllers\Admin\PhotoController::class, 'index'])->name('photo.index');
            Route::get('/create',[\App\Http\Controllers\Admin\PhotoController::class, 'create'])->name('photo.create');
            Route::post('/',[\App\Http\Controllers\Admin\PhotoController::class, 'store'])->name('photo.store');
            Route::get('/{photo}/edit',[\App\Http\Controllers\Admin\PhotoController::class, 'edit'])->name('photo.edit');
            Route::patch('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'update'])->name('photo.update');
            Route::delete('{photo}',[\App\Http\Controllers\Admin\PhotoController::class, 'delete'])->name('photo.delete');
            Route::get('/{id}',[\App\Http\Controllers\Admin\PhotoController::class, 'show'])->name('photo.show');
            Route::get('/photos/{photo}/records', [\App\Http\Controllers\Admin\PhotoController::class, 'getRecordsByType'])->name('photoRecords.by.type');

        });
    });


});












    //Route::group(['middleware' => ['auth', 'role_or_permission:admin|create role|create permission']], function() {
//
//
//
//});


Auth::routes();
//////////////////////////////// axios request for user

