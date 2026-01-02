<?php

namespace App\Http\Actions\User;

use App\Domains\User\Actions\DeleteUserAction;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction
{
    public function __invoke(DeleteUserAction $deleteUserAction): Response|JsonResource
    {
        /** @var User $user */
        $user = Auth::guard('web')->user();
        Auth::guard('web')->logout();

        $deleteUserAction->handle($user);

        session()->regenerate();

        return response()->json([
            'message' => __('user.deleted'),
        ]);
    }
}
