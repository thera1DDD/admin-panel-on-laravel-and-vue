<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutUsService extends Controller
{
    public function store($data){
        AboutUs::firstOrCreate($data);
    }

    public function update($data, AboutUs $aboutUs ){
        $aboutUs->update($data);
    }
}
