<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $table = 'roles'; // 5.5 ver, you do not have to add _
//    public $timestamp = false;  // if you do not need the auto timestamp input
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'explaination','modify_id',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    
    /**
     * Get the staff that belongs to the very role
     */
    public function staff(){
        return $this->hasMany('App\Models\Staff','role_id');
    }
    
    /**
     * Get the columns that are binding with the very role
     */
    public function columns(){
        return $this->belongsToMany('App\Models\Columns', 'role_column', 'role_id', 'column_id');
    }
    
    /**
     * Get the operations that are binding with the very role
     */
    public function operations(){
        return $this->belongsToMany('App\Models\Operations', 'role_operation', 'role_id', 'operation_id');
    }
}
