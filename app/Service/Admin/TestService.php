<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Models\Test;
use Composer\DependencyResolver\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestService extends Controller
{
    public function store(\App\Http\Requests\Test\StoreRequest $request){

         $testable_id = $request->testable_id;
         $module = Module::find($testable_id);
         $test = new Test(['name'=>$request->name]);
         $test->testable()->associate($module);
         $test->save();


    }

    public function update(\App\Http\Requests\Test\UpdateRequest $request,Test $test ){
        $data = $request->validated();
        $test->update($data);
    }


}
