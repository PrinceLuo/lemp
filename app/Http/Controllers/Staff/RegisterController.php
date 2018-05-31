<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Staff;
use App\Models\Roles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/staff/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $regex = '/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/';
        return Validator::make($data, [
            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
            // As you are using pipe line, you have to change it into array mode
            'mobile_number'=>['required','unique:clients,mobile_number','numeric',"regex:$regex"],
            'sex'=>'required|numeric|in:0,1,2',
            'age'=>'required|numeric|max:151',
            // if confirmed added, a matching password_confirmation field must be present in the input.
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Staff::create([
            'name' => $data['name'],
            'mobile_number' => $data['mobile_number'],
            'sex' => $data['sex'],
            'age' => $data['age'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);
    }
    
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if(Auth::user()->role->id!=1){
            return redirect()->back()->withErrors('Permission deny! You are not Boss!');
        }
        $roles = Roles::get();
        return view('admin_dashboard.pages.register')->with('role_list', $roles);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // do not forget to add Illuminate\Http\Request and Illuminate\Auth\Events\Registered
    // as this function need the two class
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // different with the default register, we do not want this new staff
        // to be logined right coming after the registration
//        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
