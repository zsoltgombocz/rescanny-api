<?php

namespace App\Http\Actions\Auth;

use App\Domains\Auth\MagicLink\UseMagicLinkAuthentication;
use App\Enums\GeneralResult;
use App\Http\Requests\MagicLinkAuthenticationRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class MagicLinkAuthenticationAction
{
    public function __invoke(MagicLinkAuthenticationRequest $request): Response
    {
        $user = User::query()->where('email', $request->email)->first();

        if (empty($user)) {
            $user = User::query()->create(['email' => $request->email, 'locale' => app()->getLocale()])->fresh();
        }

        /** @var User $user */
        $result = UseMagicLinkAuthentication::process($user);

        return response()->json(
            data: [
                'message' => __("auth.magic_link.$result->value"),
            ],
            status: $result === GeneralResult::Success ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }
}
