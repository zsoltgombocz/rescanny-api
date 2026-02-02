<?php

namespace App\Models;

use App\Domains\User\Concerns\HasDisplayName;
use App\Domains\User\Concerns\HasLocalePreferences;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements HasLocalePreference
{
    use Billable;
    use HasDisplayName;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use HasLocalePreferences;
    use HasUuids;
    use Notifiable;

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

    /**
     * @return HasMany<EmailChange, $this>
     */
    public function emailChanges(): HasMany
    {
        return $this->hasMany(EmailChange::class);
    }

    public function magicLink(): string
    {
        return config('app.webapp_url').'/login/magic-link?token='.$this->magic_link_uuid;
    }
}
