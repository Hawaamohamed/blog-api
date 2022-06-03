<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
      
    protected $table = 'Category';
    protected $fillable = ['name', 'user_id', 'status', 'image', 'slug'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }
    
}
