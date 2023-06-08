<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';
    protected $guarded = false;

    public function category()
    {
        return $this->hasMany(Category::class, 'columns_id');
    }
}
