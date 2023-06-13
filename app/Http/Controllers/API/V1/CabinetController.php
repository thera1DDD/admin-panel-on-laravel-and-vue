<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\API\Cabinet\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CabinetController extends MainApiController
{
    public function update(StoreRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images/users', 'public');
            $data['photo'] = Storage::disk('public')->url($path);
        }
        $user = User::find($data['userId']);
        if ($user) {
            if (isset($data['email'])) {
                $existingUser = User::where('email', $data['email'])->where('id', '!=', $data['userId'])->first();
                if (isset($existingUser)) {
                    return response()->json(['success' => false, 'message' => 'Электронная почта уже существует'], 422);
                }
                else{
                    if(isset($data['password'])){
                        $data['password'] = bcrypt( $data['password']);
                    }
                    $user->update($data);
                    return response()->json([
                        'user' => $data,
                        'status' => true
                    ]);
                }
            }

        }
        else{
            return $this->error('Пользователь не найден', 404);
        }
    }
}














