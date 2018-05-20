<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tasl Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles applications authenticated clients that missions
    | related to the role of public clients. All the clients that have to pass
    | the authentication before implementing the functions inside the very 
    | controller.
    |
    */
    
    public function __construct() {
        // name of the guard
        $this->middleware('auth:clients');
    }
    
    public function index(){
        return view('clients.pages.dashboard');
    }
}
