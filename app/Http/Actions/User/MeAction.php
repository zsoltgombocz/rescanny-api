<?php

namespace App\Http\Actions\User;

use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class MeAction
{
    public function __invoke(): Response|JsonResource
    {
        /** @var User $user */
        $user = Auth::guard('web')->user();

        return $user->toResource();
    }
}
