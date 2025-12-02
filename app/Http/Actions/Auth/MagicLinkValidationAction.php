<?php

namespace App\Http\Actions\Auth;

use App\Domains\Auth\MagicLink\UseMagicLinkAuthentication;
use App\Http\Requests\MagicLinkValidationRequest;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class MagicLinkValidationAction
{
    public function __invoke(MagicLinkValidationRequest $request): Response
    {
        if (Auth::guard('web')->check()) {
            return response()->json(null, Response::HTTP_OK);
        }

        $user = UseMagicLinkAuthentication::validate($request->input('token'));

        if (empty($user)) {
            return response()->json([
                'message' => __('auth.magic_link.expired'),
            ], 422);
        }

        $message = $user->last_login === null ? __('auth.magic_link.registration.success') : __('auth.magic_link.login.success');

        Auth::guard('web')->login($user);

        return response()->json([
            'message' => $message,
            'user' => $user->toResource(),
        ]);
    }
}
