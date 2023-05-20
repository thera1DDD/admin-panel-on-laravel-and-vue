<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Artwork;

class ArtworkService extends Controller
{
    public function store($data){
        $filename = $data['filename'];
        $filename_name = time() . '_' . $filename->getClientOriginalName();
        $filename_path = $filename->storeAs('artworks/books', $filename_name, 'public');
        $data['filename'] = $filename_path;
        Artwork::firstOrCreate($data);
    }

    public function update($artwork,$data){
        $artwork->update($data);
    }
}
