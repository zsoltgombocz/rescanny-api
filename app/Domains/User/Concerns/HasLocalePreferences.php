<?php

namespace App\Domains\User\Concerns;

use Carbon\Factory;

trait HasLocalePreferences
{
    public function preferredLocale(): string
    {
        return $this->locale;
    }

    public function preferredTimezone(): string
    {
        return $this->timezone;
    }

    public function carbonFactory(): Factory
    {
        return new Factory([
            'locale' => $this->preferredLocale(),
            'timezone' => $this->preferredTimezone(),
        ]);
    }
}
