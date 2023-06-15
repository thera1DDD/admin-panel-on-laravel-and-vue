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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
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
            'verification_code' => $verificationCode, // Сохранение кода подтверждения в модели пользователя
        ]);

        // Отправка уведомления с кодом подтверждения
        $user->notify(new VerificationCodeNotification($verificationCode));

        return response()->json(['user' => $user], 201);
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
            return response()->json(['error' => 'User not found'], 404);
        }

        // Проверка кода подтверждения
        if ($user->verification_code == $request->input('code')) {
            $user->verification_code = null; // Обнуляем код подтверждения
            $user->save();
            return response()->json(['message' => 'Registration successful','status'=>true], 200);
        } else {
            return $this->error('Invalid verification code',400);
        }
    }

    private function generateVerificationCode()
    {
        // Ваша логика для генерации кода подтверждения
        // Например, можно использовать функцию для генерации случайного числа или комбинации символов
        return rand(1000, 9999); // В этом примере генерируется случайное четырехзначное число
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
