<?php

namespace App\Http\Actions\User;

use App\Domains\User\Actions\InitiateUserEmailChangeAction;
use App\Enums\GeneralResult;
use App\Http\Requests\RequestEmailChangeRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class RequestEmailChangeAction
{
    public function __invoke(
        RequestEmailChangeRequest $request,
        InitiateUserEmailChangeAction $initiateUserEmailChange,
    ): Response|JsonResource {
        /** @var User $user */
        $user = Auth::user();

        if ($user->email === $request->get('new_email')) {
            return GeneralResult::Success->asResponse('user.personal.email-change.not-needed');
        }

        $initiateUserEmailChange->handle($user, $request->get('new_email'));

        return response()->json([
            'message' => __('user.personal.email-change.code-sent'),
            'codeSent' => true,
        ]);
    }
}
