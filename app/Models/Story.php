<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Story extends Model
{
    use HasFactory; 
    use Translatable;

    protected $guarded = [];

    protected $translatable = ['title'];



    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
