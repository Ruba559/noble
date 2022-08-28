<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TCG\Voyager\Traits\Translatable;

class User  extends  \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    
    use Translatable;

    protected $translatable = ['name'];


  
    protected $fillable = [
        'name',
        'email',
        'password',
        'long' ,
        'lat',
        'status',
        'fcm_token',
        'slug',
        'mobile_number',
        'social_id',
        'social_type',
        'email_verified_at'
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
