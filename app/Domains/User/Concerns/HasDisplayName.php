<?php

namespace App\Domains\User\Concerns;

use Illuminate\Support\Str;

trait HasDisplayName
{
    public function getUserNameAttribute(): string
    {
        return Str::slug($this->display_name);
    }

    public function getDisplayNameAttribute(): string
    {
        if (empty($this->first_name) && empty($this->last_name)) {
            return __('user');
        }

        return "$this->first_name $this->last_name";
    }

    public function getDisplayFirstNameAttribute(): string
    {
        return $this->first_name ?? __('user');
    }
}
