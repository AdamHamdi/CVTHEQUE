<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function cvs() {
    	return $this->belongsTo("App\Cv");
    }
}
