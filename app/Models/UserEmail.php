<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserEmail extends User  implements MustVerifyEmail
{
    use HasFactory;
    protected $table = "users";

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

