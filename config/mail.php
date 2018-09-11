<?php

return [
    // Mail Driver
    'driver' => env('MAIL_DRIVER', 'smtp'),

    // SMTP Host Address
    'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),

    // SMTP Host Port
    'port' => env('MAIL_PORT', 2525),

    // Global "From" Address
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'from@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example')
    ],

    // E-Mail Encryption Protocol
    'encryption' => env('MAIL_ENCRYPTION', null),

    // SMTP Server Username
    'username' => env('MAIL_USERNAME', '571eb2ed2bc41c'),

    // SMTP Server Password
    'password' => env('MAIL_PASSWORD', '5c5a3f098aa945'),

    // Sendmail System Path
    'sendmail' => '/usr/sbin/sendmail -bs',

    // Mail "Pretend"
    'pretend' => env('MAIL_PRETEND', false),
];
