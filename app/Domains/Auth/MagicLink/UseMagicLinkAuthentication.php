<?php

namespace App\Domains\Auth\MagicLink;

use App\Enums\GeneralResult;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

readonly class UseMagicLinkAuthentication
{
    public static function process(User $user): GeneralResult
    {
        $user->magic_link_uuid = Str::uuid();
        $user->magic_link_expires_at = now()->addMinutes(5);
        $user->save();

        try {
            $sentMessage = Mail::to($user->email)->send(new MagicLinkMail($user));

            return GeneralResult::fromBool((bool) $sentMessage);
        } catch (Exception $e) {
            report($e);

            return GeneralResult::Failed;
        }
    }

    public static function validate(string $uuid): ?User
    {
        $userWithToken = User::query()->where('magic_link_uuid', $uuid)->first();

        if (
            empty($userWithToken) ||
            empty($userWithToken->magic_link_expires_at) ||
            $userWithToken->magic_link_expires_at->isPast()
        ) {
            return null;
        }

        return $userWithToken;
    }
}
