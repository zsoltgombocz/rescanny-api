<?php

namespace App\Enums;

enum GeneralResult: string
{
    case Success = 'success';
    case Failed = 'failed';

    public static function fromBool(bool $bool): self
    {
        return match ($bool) {
            true => self::Success,
            default => self::Failed,
        };
    }
}
