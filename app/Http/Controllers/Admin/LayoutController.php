<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\User;

class LayoutController extends Controller
{
    public function index()
    {
        $userCount = User::all()->count();
        return view('layouts.admin',compact('userCount'));
    }
}
