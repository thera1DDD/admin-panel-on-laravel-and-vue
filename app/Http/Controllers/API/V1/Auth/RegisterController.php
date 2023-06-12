<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Register\StoreRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\ColumnResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Http\Resources\Course\SingleCourseResource;
use App\Models\Category;
use App\Models\Column;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Mod;

class RegisterController extends MainApiController
{
    protected function register(StoreRequest $request)
    {
        $data = $request->validated();
        // проверка на сущетсвование пользователя
        $existingUser = User::where('email', $data['email'])->first();
        if ($existingUser) {
            return $this->error('Пользователь c такой почтой уже существует',409);
        }
        else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('API Token')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
                'status' => false
            ]);
        }
    }



    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Аутентификация пользователя
        if (Auth::attempt($credentials)) {
            // Аутентификация успешна

            // Получение пользователя
            $user = Auth::user();

            // Генерация токена
            $token = $user->createToken('API Token')->accessToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
                'status' => true
            ], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }














//    public function getAll($location){
//        if($location == 'header' or $location =='menu'){
//            $categories = Category::where('location',$location)->get();
//            return CategoryResource::collection($categories);
//        }
//        else{
//            $columns = Column::with(['category' => function ($query) use ($location) {
//                $query->where('location', $location);
//            }])->get();
//            return ColumnResource::collection($columns);
//        }
//    }
}
