<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function author() {
        return $this->belongsTo('App\author');
    }
    
    public function admin() {       
        return $this->belongsTo('App\Admin');
    }
}
