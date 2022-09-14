<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'title',
        'content'
    ];
    public function user()
    {
        #go to thr post table and look for the column user_id automaticlly by default if you named it different use hasOne('App\models\Post','name')
        #and if the id in user is not called id insert it's name as a third parameter
        return $this->belongsTo('App\models\User');
    }

    public function photos()
    {
        return $this->morphMany('App\models\Photo','imageable');
    }
    public function tags()
    {
        return $this->morphToMany('App\models\Tag','taggable');
    }
}

#belongsTo oppsite the hasOne function
