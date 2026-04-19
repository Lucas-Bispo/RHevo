<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Carbon;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::query()->updateOrCreate(
    ['email' => 'test@example.com'],
    [
        'name' => 'Test User',
        'password' => 'password',
        'email_verified_at' => Carbon::now(),
    ]
);

echo 'USER_ID='.$user->id.PHP_EOL;
echo 'EMAIL='.$user->email.PHP_EOL;
echo 'EMAIL_VERIFIED_AT='.$user->email_verified_at?->toDateTimeString().PHP_EOL;
echo 'TOTAL_USERS='.User::query()->count().PHP_EOL;
