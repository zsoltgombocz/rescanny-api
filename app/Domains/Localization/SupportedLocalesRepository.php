<?php

namespace App\Domains\Localization;

use Illuminate\Support\Collection;

readonly class SupportedLocalesRepository
{
    /**
     * @return Collection<string, string>
     */
    public function getAll(): Collection
    {
        /** @var array<string, string> $locales */
        $locales = config('app.supported_locales');

        return Collection::make($locales);
    }

    public function isValidLocale(?string $locale): bool
    {
        if(empty($locale)) {
            return false;
        }

        return $this->getAll()->has($locale);
    }
}
