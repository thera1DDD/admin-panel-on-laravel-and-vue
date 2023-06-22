<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\User;
use App\Service\LanguageService;

class LayoutController extends Controller
{
    public function index()
    {
        $userCount = User::all()->count();
        return view('layouts.admin',compact('userCount'));
    }
}
