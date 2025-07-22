<?php

return [
    'pgsql' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: '5432',
        'database' => getenv('DB_NAME') ?: 'course_db',
        'username' => getenv('DB_USERNAME') ?: 'user',
        'password' => getenv('DB_PASSWORD') ?: 'password'
        ]
    ];