<?php

namespace App\Http\Actions\User;

use App\Domains\User\Actions\InitiateUserEmailChangeAction;
use App\Enums\GeneralResult;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class UpdatePersonalInformationAction
{
    public function __invoke(
        UpdatePersonalInformationRequest $request,
        InitiateUserEmailChangeAction $initiateUserEmailChange
    ): Response|JsonResource {
        /** @var User $user */
        $user = Auth::user();

        $success = $user->update($request->all());

        return GeneralResult::fromBool($success)->asResponse('user.personal.update');
    }
}
