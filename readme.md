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

Part2: Unauthenticated & intended page after authenticated

1. add 【session()->put('url.intended', url()->current());】 in function unauthenticated()
  in Exception/Handler.php to keep the current intended url into the session 【url.intended】;
  after this, 
  P.S.: redirect()->intended('backup_url') will read the session()->get('url.intended')
  if session()->has('url.intended') fails, it will redirect to the 'backup_url' instead.

20180524

==================================================

Part3: Staff

1. Add a staff login & register. The difference is, register is auth with boss,
   you need to pass the authentication with role of boss, then you can use the 
   registration functions. (add roles filter in exception/Handler.php and
   middleware/RedirectIfAuthenticated.php and config/auth.php)

==================================================

Part4: Customize Administration Dashboard with free permissions authorization

In this case, the boss, who has the top permission over the whole users of the 
Administration Dashboard:
1. Create a kind of role for the whole corporation. While the boss create a new
   role, he or she has to assign some columns and operations for this role, 
   authorizing this role permissions to access certain columns and certain 
   operations.
2. Register a staff of this corporation. While the boss register a new staff,
   he or she has to assign a existing role for him or her.

3. To bind various properties of permissions, several data tables named 【role_xxx】
   are established. Then, to enable a role to demonstrate permissions, also 
   to enable one kind of permission to demonstrate roles that own it, we use
   the many-to-many relationships in eloquent. To digger deeper, we have to design 
   a better structure to serve the free permission authorization. E.g.: 
   Middleware, Middleware Group, Eloquent relationships and tables relationships.

Never stand still!!!

20180531

==================================================

Extra:
I add a new line here to test whether the git works or not on GitHub...

20180621

==================================================

Part5: WebSocket implementation

1. composer require pusher/pusher-php-server "~3.0" (under Laravel 5.5)

2. Go to 【https://pusher.com】 sign in with your Google or Github account, create
   a new app, get the ID, KEY, SECRET and CLUSTER into your 【.env】 file

3. Change the BROADCAST_DRIVER from the default 【log】 to 【pusher】

4. We need to make an Event as the object for the Pusher to broadcast. Please to
   go the Part5 cont. part (the comming next part) and learn how to build Laravel Event. 

5. uncomment one line: 【App\Providers\BroadcastServiceProvider::class】 in config/app.php 

6. npm install --save laravel-echo pusher-js

7. uncomment the Echo part in resources\assets\js\boostrap.js

Something wrong with this tools. Considering of switching to Ratchet

8. I change to implement a javascript support by Pusher official instead of the Vue js

==================================================

Part5 (cont.) Laravel Event

The Laravel Event is somehow a more powerful separated task (or function) that
would be widely implemented and heavily relied by the Laravel Broadcasting and
Notification

php artisan event:generate

build a route to test the event and the event listener

==================================================

Part5 (cont.) Ratchet Library

Alternatively, we could implement the Ratchet Library to run WebSocket

1. composer require cboden/ratchet
(Later I will post the full steps)
