<?php

return [
    'email' => env('ADMIN_EMAIL'),

    // Either a bcrypt/argon hash (recommended) or a plain-text password.
    // Generate a hash with: php artisan tinker --execute="echo bcrypt('secret')"
    'password' => env('ADMIN_PASSWORD'),

    // Where new membership applications are announced. This must be a real
    // config key: reading env() inline as a default silently yields null once
    // `php artisan config:cache` runs, which the deploy does on every release.
    'notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'admin@uacjp.uz'),
];
