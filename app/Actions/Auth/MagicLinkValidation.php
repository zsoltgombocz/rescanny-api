<?php

namespace App\Actions\Auth;

use App\Domains\Auth\MagicLink\UseMagicLinkAuthentication;
use App\Http\Requests\MagicLinkValidationRequest;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class MagicLinkValidation
{
    public function __invoke(MagicLinkValidationRequest $request): Response
    {
        if (Auth::check()) {
            return response()->json(null, Response::HTTP_OK);
        }

        $user = UseMagicLinkAuthentication::validate($request->input('token'));

        if (empty($user)) {
            return response()->json([
                'message' => __('auth.magic_link.expired'),
            ], 422);
        }

        $message = $user->last_login === null ? __('auth.magic_link.registration.success') : __('auth.magic_link.login.success');

        Auth::login($user);

        return response()->json([
            'message' => $message,
            'user' => $user,
        ]);
    }
}
