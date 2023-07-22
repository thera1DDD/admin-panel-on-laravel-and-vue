<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favourite\StoreRequest;
use App\Http\Requests\Favourite\UpdateRequest;
use App\Models\Course;
use App\Models\Favourite;
use App\Models\User;
use App\Service\FavouriteService;

class FavouritesController extends Controller
{


    protected $favouriteService;
    public function __construct(FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;
    }

    public function index(){
       $favourites = Favourite::all();
       return view('favourite.index',compact('favourites'));
    }

    public function create(){
        $favourites = Favourite::all();$courses = Course::all(); $users = User::all();
        return view('favourite.create',compact('favourites','users','courses'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->favouriteService->store($data);
        return redirect()->route('favourite.index')->with('успешно','Избранное пользователя добавлено');
    }


    public function edit(Favourite $favourite){
        $courses = Course::all(); $users = User::all();
        return view('favourite.edit',compact('favourite','users','courses'));
    }


    public function delete(Favourite $favourite){
        $favourite->delete();
        return redirect()->route('favourite.index')->with('success','Избранное пользователя удалено');
    }

    public function update(UpdateRequest $request, Favourite $favourite){
        $data = $request->validated();
        $this->favouriteService->update($data,$favourite);
        return redirect()->route('favourite.index')->with('success','Избранное пользователя обновлено');
    }

}
