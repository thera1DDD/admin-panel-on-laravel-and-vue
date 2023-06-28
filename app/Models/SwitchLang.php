<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwitchLang extends Model
{
    protected $table = 'switch_langs';
    protected $guarded = false;


    public function language(){
        return $this->belongsTo(Language::class,'languages_id','id');
    }
}
