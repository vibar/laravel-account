# Laravel Users Activation

- Laravel 5.5 account verification (via e-mail confirmation) for new registers.
- Messages are available in english and portuguese (BR). See `resources/lang/vendor/account`

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
## Update `.env`

Update `APP_URL`. This URL will be used for the activation link sent by email.

Use [Mailtrap](https://mailtrap.io/) to see the emails sent. Update `MAIL_USERNAME` and `MAIL_PASSWORD`

## Screenshots

![Sign up](https://i.imgur.com/E8VqEHx.png "Sign up")

![Login not available until activation](https://i.imgur.com/l3en5Ll.png "Login not available until activation")

![Email with activation link](https://i.imgur.com/mYjRRqT.png "Email with activation link")

![Account activated](https://i.imgur.com/rn9YjCG.png "Account activated")
