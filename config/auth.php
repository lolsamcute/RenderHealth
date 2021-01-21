<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',
        ],
        'patient_api' => [ 
            'driver' => 'passport', 
            'provider' => 'patients', 
        ], 
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
        'doctor_api' => [ 
            'driver' => 'passport', 
            'provider' => 'doctors', 
        ], 
        'nurse' => [
            'driver' => 'session',
            'provider' => 'nurses',
        ],
        'employee' => [
            'driver' => 'session',
            'provider' => 'employees',
        ],
        'hospital' => [
            'driver' => 'session',
            'provider' => 'hospitals',
        ],
        'administrator' => [
            'driver' => 'session',
            'provider' => 'administrators',
        ],
         'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Patient::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Doctor::class,
        ],
        'nurses' => [
            'driver' => 'eloquent',
            'model' => App\Models\Nurse::class,
        ],
        'employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,
        ],
        'hospitals' => [
            'driver' => 'eloquent',
            'model' => App\Models\Hospital::class,
        ],
        'administrators' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrator::class,
        ],
         'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'patients' => [
            'provider' => 'patients',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'doctors' => [
            'provider' => 'doctors',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'nurses' => [
            'provider' => 'nurses',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'employees' => [
            'provider' => 'employees',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'hospitals' => [
            'provider' => 'hospitals',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'administrators' => [
            'provider' => 'administrators',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
