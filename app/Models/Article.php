<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Article extends Model
{
    use HasFactory;
    use Translatable;
  
    protected $translatable = ['title' , 'description' , 'body' , 'seo_title' , 'seo_description'];

    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , 'author_id');
    }
}
