# [Abandoned] Lapiuth - Laravel API Auth

![Run Tests](https://github.com/datakrama/lapiuth/workflows/Run%20Tests/badge.svg)

As we all know, Laravel provides built-in features for authentication. But, that's only for the web, not the API. Because of this, Lapiuth was made.

Lapiuth is ready-to-use authentication library for Laravel based API server. This library is simple. But, it can still help our work. We hope so for you.

## Requirements
- [Laravel 7.x](https://github.com/laravel/laravel)
- [Passport 8.x](https://github.com/laravel/passport)
- [Personal Access Tokens with Passport](https://laravel.com/docs/6.x/passport#personal-access-tokens)
- [Lapires 2.x](https://github.com/datakrama/lapires)

## Laravel Compatibility

|   Laravel                             | Package                                               |
| ------------------------------------- | ----------------------------------------------------- |
| [6.x](https://laravel.com/docs/6.x)   | [1.x](https://github.com/datakrama/lapiuth/tree/v1)   |
| [7.x](https://laravel.com/docs/7.x)   | [2.x](https://github.com/datakrama/lapiuth/tree/v2)   |

## Installation

> Before using this package, make sure you have set your Passport Personal Access Token. You can see the documentation at [https://laravel.com/docs/7.x/passport](https://laravel.com/docs/7.x/passport)

$ `composer require datakrama/lapiuth:"~2.0"`

## Usages

### Publish 
To publish config, all you need is run this command:

$ `php artisan vendor:publish --provider="Datakrama\Lapiuth\ServiceProvider"`

In this config, you can change client's url, password url, and email verify url.

### Auth's model trait

Because this package uses the default auth, you can use traits in your auth model, the same as Laravel do. There are two traits you can use, `Datakrama\Lapiuth\Traits\CanResetPassword` and `Datakrama\Lapiuth\Traits\MustVerifyEmail`. Each trait is to reset the password and email verification.

#### Example:
```
<?php

namespace App;

use Datakrama\Eloquid\Traits\Uuids;
use Datakrama\Lapiuth\Traits\CanResetPassword;
use Datakrama\Lapiuth\Traits\MustVerifyEmail as MustVerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Uuids, HasApiTokens, HasRoles, Notifiable, CanResetPassword, MustVerificationEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

# Licence
The MIT License (MIT). Please see [License File](https://github.com/datakrama/lapiuth/blob/master/LICENSE.md "License File") for more information.
