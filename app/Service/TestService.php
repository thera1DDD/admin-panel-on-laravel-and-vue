<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestService extends Controller
{
    public function store($data)
    {
        $data['testable_type'] = "App\Models\\" . $data['testable_type'];
        Test::create($data)->testable()->associate($data['testable_type']::findOrFail($data['testable_id']))->save();
    }

    public function update($data, $test)
    {
        if (isset($data['testable_type'])) {
            $data['testable_type'] = "App\Models\\" . $data['testable_type'];
            $test->testable()->associate($data['testable_type']::findOrFail($data['testable_id']));
        }
        $test->update($data);
    }
}
