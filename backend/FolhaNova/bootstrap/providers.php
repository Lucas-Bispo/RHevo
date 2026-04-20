<?php

return [
    App\Providers\AppServiceProvider::class,
    env('TELESCOPE_ENABLED', false) ? App\Providers\TelescopeServiceProvider::class : null,
    App\Providers\VoltServiceProvider::class,
];
