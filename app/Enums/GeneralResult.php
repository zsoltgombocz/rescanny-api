<?php

namespace App\Enums;

use Symfony\Component\HttpFoundation\Response;

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

    public function asResponse(string $translationPath): Response
    {
        return response()->json(
            data: [
                'message' => __($translationPath.'.'.$this->value),
            ],
            status: $this === GeneralResult::Success ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
