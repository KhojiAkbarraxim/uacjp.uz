<?php

return [
    'email' => env('ADMIN_EMAIL'),

    // Either a bcrypt/argon hash (recommended) or a plain-text password.
    // Generate a hash with: php artisan tinker --execute="echo bcrypt('secret')"
    'password' => env('ADMIN_PASSWORD'),
];
