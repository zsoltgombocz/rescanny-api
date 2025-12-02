<?php

namespace App\Http\Actions\User;

use App\Domains\User\Events\UserDeleted;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction
{
    public function __invoke(): Response|JsonResource
    {
        /** @var User $user */
        $user = Auth::guard('web')->user();
        Auth::guard('web')->logout();

        UserDeleted::dispatch($user);

        $user->delete();

        session()->regenerate();

        return response()->json([
            'message' => __('user.deleted'),
        ]);
    }
}
