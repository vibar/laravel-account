# laravel-account
Laravel 5.5 users activation.


## Install


```
composer require vibar/laravel-account
```

Add service provider in `config/app.php`

```
Vibar\Account\AccountServiceProvider::class
```

## Config

Add trait to `App\Http\Controllers\Auth\LoginController`

```
use Vibar\Account\Traits\ActiveLogin;

use AuthenticatesUsers, ActiveLogin {
    ActiveLogin::authenticated insteadof AuthenticatesUsers;
}
```

Add trait to `App\Http\Controllers\Auth\RegisterController`

```
use Vibar\Account\Traits\ActiveRegister;

use RegistersUsers, ActiveRegister {
    ActiveRegister::register insteadof RegistersUsers;
}
```

Add traits to `App\User`

```
use Illuminate\Notifications\Notifiable;
use Vibar\Account\Traits\Accountable;

class User extends Authenticatable
{
    use Notifiable, Accountable;
}
```

Publish package files
```
php artisan vendor:publish --provider="Vibar\Account\AccountServiceProvider"
```
Publish Laravel auth views
```
php artisan make:auth
```

Run migrations

```
php artisan migrate
```

Include activation status template on `resources/views/auth/login.blade.php`
```
@include('vendor.account.activation._status')
```

