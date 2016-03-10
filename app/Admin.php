<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable; 

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    protected $table = 'admins';
    use Authenticatable;
    
    public function quotes() {
        return $this->hasMany('App\Quote');
    }


}


?>