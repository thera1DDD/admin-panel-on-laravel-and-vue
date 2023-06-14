<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';
    protected $guarded = false;

    public function translate()
    {
        return $this->hasMany(Translate::class, 'words_id');
    }

}
