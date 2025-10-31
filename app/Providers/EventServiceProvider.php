<?php

namespace App\Providers;

use App\Domains\Auth\Listeners\SetLoginDate;
use Illuminate\Auth\Events\Login;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        Login::class => [
            SetLoginDate::class,
        ],
    ];
}
