<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }


    public function create(){
        return view('users.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images/users', 'public');
            $data['photo'] = Storage::disk('public')->url($path);
        }
        $this->userService->store($data);
        return redirect()->route('users.index')->with('success','User created');
    }


    public function edit(User $user){
        return view('users.edit',compact('user'));
    }


    public function delete(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted');
    }


    public function update(UpdateRequest $request, User $user){
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images/users', 'public');
            $data['photo'] = Storage::disk('public')->url($path);
        }
        $this->userService->update($data,$user);
        return redirect()->route('users.index')->with('success','User updated');
    }
}
