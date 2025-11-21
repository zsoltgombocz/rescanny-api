<?php

namespace App\Domains\Auth\Listeners;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Login;

class SetLoginDate
{
    public function __invoke(Login $event): void
    {
        /** @var Admin|User $user */
        $user = $event->user;

        if ($user instanceof Admin) {
            return;
        }

        $user->last_login = now();
        $user->save();
    }
}
