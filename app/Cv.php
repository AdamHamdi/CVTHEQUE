<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function experiences() {
    	return $this->hasMany('App\Experience');
    }
    public function tranings() {
    	return $this->hasMany('App\Traning');
    }
    public function skills() {
        return $this->hasMany('App\Skill');
    }
    public function projects() {
    	return $this->hasMany('App\Project');
    }
}
