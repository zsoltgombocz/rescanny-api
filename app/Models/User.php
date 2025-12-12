<?php

namespace App\Models;

use App\Domains\User\Concerns\HasDisplayName;
use App\Domains\User\Concerns\HasLocalePreferences;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements HasLocalePreference
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasDisplayName,
        HasFactory,
        HasLocalePreferences,
        HasUuids,
        Notifiable,
        Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'locale',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'magic_link_uuid',
        'remember_token',
    ];

    protected $casts = [
        'magic_link_expires_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    public function magicLink(): string
    {
        return config('app.webapp_url').'/login/magic-link?token='.$this->magic_link_uuid;
    }
}
