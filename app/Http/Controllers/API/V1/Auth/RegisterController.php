<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\API\Register\StoreRequest;
use App\Models\User;
use App\Notifications\ResetVerificationCodeNotification;
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


    public function passwordResetSend(Request $request){
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            if($user->verification_code !=null) {
                $user->forceDelete();
            }
            $verificationCode = $this->generateVerificationCode(); // функция для генерации кода
            $user->verification_code = $verificationCode;
            $user->updated_at = now();
            $user->save();
            $user->notify(new ResetVerificationCodeNotification($verificationCode));
            return response()->json(['user' => $user,], 201);
        }
        else{
            return $this->error('User not found',404);
        }
    }

    public function passwordResetCheck(Request $request){
        $user = User::where('verification_code', $request->input('code'))->first();
        if(!$user){
            return $this->error('User not found or invalid verification code',404);
        }
        //проверка времени с отправления кода
        $createdAt = $user->updated_at;
        $currentTime = now();
        $timeDifference = $currentTime->diffInMinutes($createdAt);
        if ($timeDifference < 1) {
            if ($user->verification_code == $request->input('code')) {
                if($request->input('password')== null)
                {
                    return $this->error('Password field is empty', 404);
                }
                $user->password = bcrypt($request->input('password'));
                $user->verification_code = null; // Обнуляем код подтверждения
//                $token = $user->createToken('API Token')->accessToken;
                $user->save();
                return response()->json(['message' => 'Reset successful', 'status' => true], 200);
            }
            else {
                return $this->error('Invalid verification code', 400);
            }
        }
        else{
            // Удаление пользователя и связанных данных
            $user->verification_code = null;
            return $this->error('Срок действия проверочного кода истек.Данные сброшенны', 400);
        }

    }

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
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('verification_code', $request->input('code'))->first();

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


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if($request->input('email') == null or $request->input('password') == null){
            return $this->error('Fields is empty!');
        }
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
