<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestService extends Controller
{
    public function store($data){

//        $test = new Test();
//        $test->name = $data['name'];
//        $test->number = $data['number'];
//        $test->testable_id = $data['testable_id'];
//        $testable_id = $data['testable_id'];
//        $testable_type = "App\Models\\" . $data['testable_type'];
//        $model = $testable_type::findOrFail($testable_id);
//        $test->testable()->associate($model);
//        $test->save();
    }

    public function update($data,Test $test){
        $test->poster = $data['poster'];
        $test->name = $data['name'];
        $test->code = $data['code'];
        $test->number = $data['number'];
        $test->testable_id = $data['testable_id'];
        $testable_id = $data['testable_id'];
        $testable_type = "App\Models\\" .$data['testable_type'];
        $model = $testable_type::findOrFail($testable_id);
        $test->testable()->associate($model);
        $test->update();
    }
}
