<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*
      method one to one profile
    */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /*
    method one to many user -> post
    */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
