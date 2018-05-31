<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;
use App\Models\Columns;
use App\Models\Operations;
use App\Models\Staff;

class TaskController extends Controller {
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
        $this->middleware('auth:staff');
    }

    public function index() {
        $roles = Roles::get();
        return view('admin_dashboard.pages.dashboard', ['role_list' => $roles]);
    }

    public function newRoleForm() {
        // $this->middleware(); // a new middleware for role
        // by if-else 
        if (Auth::user()->role->id == 1) {
            $operations = Operations::get();
            $columns = Columns::get();
            return view('admin_dashboard.pages.roleForm', ['columns' => $columns, 'operations' => $operations]);
        } else {
            return redirect()->back()->withErrors('Only Boss can create a new role!');
        }
    }

    public function createRole(Request $request) {

        if (Auth::user()->role->id != 1) {
            return redirect()->back()->withErrors('Only Boss can create a new role!');
        }
        // check values inside the checkbox
//        dd($request->columns);
//        dd($request->operations);
        $modify_id = Auth::user()->id;
        $this->roleValidator($request->all())->validate();
        // insert will ignore the timestamp
        $insert_arr = array(
            'title' => $request->title,
            'explaination' => $request->explaination,
            'modify_id' => $modify_id,
        );
        // after ModelInstance->save(), you could access the new PRIMARY KEY by ModelInstance->id
        $role_id = Roles::create($insert_arr)->id;
        if ($role_id) {
            unset($insert_arr);
            $insert_arr = array();
            foreach ($request->columns as $column_id) {
                $insert_arr[] = array(
                    'role_id' => $role_id,
                    'column_id' => $column_id,
                    'modify_id' => $modify_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                );
            }
            \App\Models\role_column::insert($insert_arr);
            unset($insert_arr);
            if ($request->has('operations')) {
                foreach ($request->operations as $operation_id) {
                    $insert_arr[] = array(
                        'role_id' => $role_id,
                        'operation_id' => $operation_id,
                        'modify_id' => $modify_id,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    );
                }
                \App\Models\role_operation::insert($insert_arr);
            }
            unset($insert_arr);
            // need the key word return, otherwise it will not jump
            return $this->index();
        } else {
            return redirect()->back()->withErrors('Creating new role fails!');
        }
    }

    // Column Column1
    public function getColumn1(){
        $columns = Auth::user()->role->columns;
        $operations = Auth::user()->role->operations;
        foreach($operations as $operation){
            $op[] = $operation->id;
        }
        $no_access = true;
        foreach($columns as $column){
            if($column->id==5){
                $no_access = false;
            }
        }
        if($no_access){
            return redirect()->back()->withErrors('You do not have permission to access this column!');
        }
        $db_result = DB::table('a')->get();
        foreach($db_result as $res){
            $mod_name = Staff::find($res->modify_id)->name;
            $arr = array(
                'title' => $res->title,
                'content' => $res->content,
                'created_at' => $res->created_at,
                'updated_at' => $res->updated_at,
                'mod_name' => $mod_name,
            );
            $data[] = $arr;
            unset($arr);
        }
        return view('admin_dashboard.pages.column1',['table_data' => $data, 'ops' => $op]);
    }

    protected function roleValidator(array $data) {
        return Validator::make($data, [
                    'title' => 'required|unique:roles',
//            'email' => 'required|string|email|max:255|unique:users',
                    // As you are using pipe line, you have to change it into array mode
                    'explaination' => 'required',
                    'columns' => 'required',
        ]);
    }

    // This function is just for testing
    public function getColumns() {
        $columns = Auth::user()->role->columns;
        foreach ($columns as $c) {
            print_r($c->route);
            echo "<br>";
        }
        die();
    }

    // This function is just for testing
    public function getOperations() {
        $operations = Auth::user()->role->operations->where('');
        dd($operations);
    }

}
