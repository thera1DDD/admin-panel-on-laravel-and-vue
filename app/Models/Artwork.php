<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $table = 'artworks';
    protected $guarded = false;

    public function language(){
        return $this->belongsTo(Language::class,'languages_id','id');
    }
}
