<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Columns extends Model
{
    
    protected $table = 'columns'; // 5.5 ver, you do not have to add _
    
    /**
     * Get the roles that are binding with the very column
     */
    public function roles(){
        return $this->belongsToMany('App\Models\Roles', 'role_column', 'column_id', 'role_id');
    }
}
