<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\User;

class UserService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Пользователи',$data['name']));
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        User::firstOrCreate($data);
    }

    public function update($data, User $user ){
        event(new UserAction(auth()->user()->id, 'Обновление','Пользователи',$data['name']));
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
    }
}
