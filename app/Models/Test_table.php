<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test_table extends Model
{
    use SoftDeletes;
    protected $table = 'test_table'; // 5.5 ver, you do not have to add _
    
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 
    ];
}
