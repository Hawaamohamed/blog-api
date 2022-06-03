<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at']; //for soft delete
    protected $table = 'comments';
    protected $fillable = ['parent_id', 'user_id', 'content', 'post_id'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function post(){
        return $this->belongsToMany('App\Post');
    }

    public function replies(){
        return $this->hasMany('App\Comment', 'parent_id');
    }
}
