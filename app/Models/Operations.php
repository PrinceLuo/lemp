<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    protected $table = 'operations'; // 5.5 ver, you do not have to add _
    
    /**
     * Get the roles that are binding with the very operation
     */
    public function roles(){
        return $this->belongsToMany('App\Models\Roles', 'role_operation', 'operation_id', 'role_id');
    }
}
