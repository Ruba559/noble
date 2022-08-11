<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Complaint extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['type' , 'description' , 'reply_message'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replierUser()
    {
        return $this->belongsTo(User::class , 'replier_id');
    }
}
