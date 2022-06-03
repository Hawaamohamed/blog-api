<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile_users';
    protected $fillable = ['gender', 'user_id', 'bio', 'facebook'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


}
