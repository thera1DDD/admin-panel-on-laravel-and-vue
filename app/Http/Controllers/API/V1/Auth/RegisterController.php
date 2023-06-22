<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\API\Register\StoreRequest;
use App\Models\User;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends MainApiController
{
//    protected function register(StoreRequest $request)
//    {
//        $data = $request->validated();
//        // проверка на сущетсвование пользователя
//        $existingUser = User::where('email', $data['email'])->first();
//        if ($existingUser) {
//            return $this->error('Пользователь c такой почтой уже существует',409);
//        }
//        else{
//            if($request->password){
//                $data['password']= bcrypt($data['password']);
//            }
//            $user = User::firstOrCreate($data);
//
//            $token = $user->createToken('API Token')->accessToken;
//            return response()->json([
//                'token' => $token,
//                'user' => $user,
//                'status' => false
//            ]);
//        }
//    }

    public function register(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            if($user->verification_code !=null) {
                $user->forceDelete();
            }
        }
        // Валидация
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|string|min:8'
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        // Генерация и отправка кода на указанный email
        $verificationCode = $this->generateVerificationCode(); // функция для генерации кода
        // Добавление нового пользователя в базу данных
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>bcrypt($request->input('password')) ,
            'verification_code' => $verificationCode, // Сохранение кода подтверждения в модели пользователя
        ]);

        // Отправка уведомления с кодом подтверждения
        $user->notify(new VerificationCodeNotification($verificationCode));

        return response()->json(['user' => $user,], 201);
    }

    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return $this->error('User not found',404);
        }
        // Проверка времени
        $createdAt = $user->created_at;
        $currentTime = now();
        $timeDifference = $currentTime->diffInMinutes($createdAt);
        // Проверка на время для кода
        if ($timeDifference < 1) {
            if ($user->verification_code == $request->input('code')) {
                $user->verification_code = null; // Обнуляем код подтверждения
                $token = $user->createToken('API Token')->accessToken;
                $user->save();
                return response()->json(['message' => 'Registration successful', 'status' => true,'token'=>$token], 200);
            }
            else {
                return $this->error('Invalid verification code', 400);
            }
        }
        else{
            // Удаление пользователя и связанных данных
            $user->forceDelete();
            return $this->error('Срок действия проверочного кода истек.Данные сброшенны', 400);
        }
    }

    private function generateVerificationCode()
    {
        return rand(1000, 9999);
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
