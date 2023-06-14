<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\API\Register\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if($request->password){
                $data['password']= bcrypt($data['password']);
            }
            $user = User::firstOrCreate($data);

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
