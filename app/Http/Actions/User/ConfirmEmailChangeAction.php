<?php

namespace App\Http\Actions\User;

use App\Domains\User\Actions\ConfirmUserEmailChangeAction;
use App\Enums\GeneralResult;
use App\Http\Requests\ConfirmEmailChangeRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ConfirmEmailChangeAction
{
    public function __invoke(
        ConfirmEmailChangeRequest $request,
        ConfirmUserEmailChangeAction $confirmUserEmailChangeAction,
    ): Response|JsonResource {
        /** @var User $user */
        $user = Auth::user();

        $success = $confirmUserEmailChangeAction->handle($user, $request->get('code'));

        return GeneralResult::fromBool($success)->asResponse('user.email_changed');
    }
}
