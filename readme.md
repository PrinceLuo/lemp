<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


==================================================

Part1: Signin & Signup (including middleware and guards)

1. Sign up. Go to the project【how-to-laravel】and check the default registerController and the customized registerController. Then write your own regesterController
for Clients.

2. In your customized registerController, overwrite the functions: showRegistrationForm(), create(array $data), validator(array $data)
   and set your Clients Model at the same time. As we are going to implementing the defaut Laravel Auth, so we have to let our
   model to extend the Authenticatable. And do not forget to set the new guard for your new model Clients
   Coming next, we will build our customized loginController, meanwhile to set our customized middleware steps by steps. 
   (As the loginController is still empty now, if you have already signed in, it will go to guard->login, that is the reason why you will redirect to 
    home rather than anyother path as it is implementing the default setting path.) 
	
20180518

==================================================

Part1(cont.): Signin & Signup (including middleware and guards)

Before this practice, please note that PUT method would stay in the current url,
as I go to the route 'clients/logout', it will redirect to '/'. But it showed
'127.0.0.1/clients/logout'. Pay attention if you implement PUT and DELETE, as
it it not suggested to use PUT or DELETE in a request form.

LoginController is created. Copy and rewrite functions needed. Belows are some 
points that worth attentions:
1. add 【use Illuminate\Foundation\Auth\AuthenticatesUsers;】if you want to 
【use AuthenticatesUsers;】, the Auth from Laravel
2. add 【use Illuminate\Support\Facades\Auth;】if you want to implement the
default style of the function guard(); also create a new guard for your own
customized guard
3. add 【$this->middleware('guest:clients')->except('logout');】 in the 
constructor
4. set the variable 【protected $redirectTo = '/clients/dashboard';】; the same
as RegisterController
5. the function username()
6. validation. When implementing the pipeline in the regex, you have to change
the sring into array of the validation value. Check again in the moble_number
validation
7. in the \app\Http\Middleware\RedirectIfAuthenticated.php,
add a switch to handle the guard 【clients】, as we are not using the default
【users】, otherwise it will always run the program as the default setting after
login

20180520

==================================================

Part1(cont.): Signin & Signup (including unauthenticated)

1. add 【session()->put('url.intended', url()->current());】 in function unauthenticated()
  in Exception/Handler.php to keep the current intended url into the session 【url.intended】;
  after this, 
  P.S.: redirect()->intended('backup_url') will read the session()->get('url.intended')
  if session()->has('url.intended') fails, it will redirect to the 'backup_url' instead.

20180524

==================================================