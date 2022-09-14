<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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

    public function post()
    {
        #go to thr post table and look for the column user_id automaticlly by default if you named it different use hasOne('App\models\Post','name')
        #and if the id in user is not called id insert it's name as a third parameter
        // return $this->hasMany('App\models\Post');
        return $this->hasOne('App\models\Post');
    }
    public function posts()
    {

        return $this->hasMany('App\models\Post');
    }
    public function roles()
    {
        return $this->belongsToMany('App\models\Role')->withPivot("created_at");
    }

    public function photos()
    {
        return $this->morphMany('App\models\Photo','imageable');
    }
}
