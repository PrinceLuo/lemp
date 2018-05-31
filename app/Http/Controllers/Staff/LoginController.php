<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * You need to copy and overwrite a lot of functions in 
     * \Illuminate\Foundation\Auth\AuthenticatesUsers.php
     * as the basic settings are much different with your
     * customized methods.
     */
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // Otherwise, it will redirect you to default '/home'
    protected $redirectTo = '/staff/dashboard';
    // Also, there are two variables which are worth your attention.
    // $maxAttempts and $decayMinutes
    // modify these two variables to fit your app
    // have a look at \Illuminate\Foundation\Auth\ThrottlesLogins.php

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // logout link is not cover under the guest middleware
        // guest as clients. Make sure you build the new guard as clients
        $this->middleware('guest:staff')->except('logout');
    }
    
    /** 
     * You may need to modify the function credentials(Request $request) in
     * \Illuminate\Foundation\Auth\AuthenticatesUsers.php, to fit your app
     * now the method is implementing with the username(), which is mobile_number,
     * and the password
     */
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
//        session()->put('url.intended', url()->previous());
        return view('admin_dashboard.pages.login');
    }
    
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    
    protected function guard()
    {
        // add use Auth at top
        return Auth::guard('staff');
    }
    // we set the web as clients, if you need a new guard,
    // create a new one and use guard(new_guard)
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'mobile_number';
    }
    
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $regex = '/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/';
        $this->validate($request, [
            $this->username() => ['required','numeric',"regex:$regex"],
            'password' => 'required|string',
        ]);
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    // overwrite this method if you want to redirect a place at your will
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
     */
    
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    // If you have more than one role in your clients, you have to rewrite
    // this method. Details in the project【how-to-laravel】
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
//        return $this->authenticated($request, $this->guard()->user());
    }
    */
}
