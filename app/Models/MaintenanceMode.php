<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MaintenanceMode extends Model
{
    use HasTranslations;

    protected $fillable = [
        'enabled',
        'display_text',
        'from',
        'to',
    ];

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'display_text',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public static function current(): ?self
    {
        return static::first();
    }

    public function isActive(): bool
    {
        if ($this->enabled) {
            return true;
        }

        if (! empty($this->from) && ! empty($this->to)) {
            return now()->between($this->from, $this->to);
        }

        return false;
    }

    public function isUpcoming(): bool
    {
        return ! empty($this->from) && now()->lt($this->from);
    }
}
