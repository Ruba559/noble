<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class BackNotification extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['message'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , 'from_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class , 'to_id');
    }
}
