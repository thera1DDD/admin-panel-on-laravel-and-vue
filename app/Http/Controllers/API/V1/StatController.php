<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\Stat\StoreRequest;

use App\Models\Stat;


class StatController extends MainApiController
{
    public function postStat(StoreRequest $request){
        $data = $request->validated();
        $stat = Stat::create($data);
        return $stat;
    }
}
