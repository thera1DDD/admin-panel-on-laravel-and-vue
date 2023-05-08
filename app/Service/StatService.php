<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Favourite;
use App\Models\Stat;

class StatService extends Controller
{
    public function store($data){
        Stat::firstOrCreate($data);
    }
    public function update($data,Stat $stat){
        $stat->update($data);
    }
}
