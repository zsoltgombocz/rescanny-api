<?php

namespace App\Actions\User;

use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class MeAction
{
    public function __invoke(): Response|JsonResource
    {
        if ($user = Auth::user()) {
            /** @var User $user */
            return $user->toResource();
        }

        return response()->json(null, 400);
    }
}
