<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements FilamentUser
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        /** @var string[] $emails */
        $emails = config('filament.trusted_emails');

        return collect($emails)->contains($this->email);
    }
}
