<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; //for soft delete
    protected $table = 'posts';
    protected $fillable = ['title', 'user_id', 'content', 'image', 'slug', 'status'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tag(){
        return $this->belongsToMany('App\Tag');
    }
    public function comments(){
        return $this->hasMany('App\Comment')->whereNull('parent_id'); //wher parent_id = null this mean that it want the main comments not replies
    }
}
