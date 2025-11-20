<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function __construct(User $resource)
    {
        parent::__construct($resource);
    }

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'displayName' => $this->display_name,
            'avatar' => $this->avatarLetters(),
            'email' => $this->email,
            'lastLogin' => $this->carbonFactory()->make($this->last_login)?->isoFormat('LLL'),
            'locale' => $this->preferredLocale(),
            'subscription' => [
                'label' => 'Pro',
                'price' => '4 990 Ft / hó',
                'nextBilling' => '2025. január 15',
            ],
        ];
    }

    private function avatarLetters(): string
    {
        $nameFragments = explode(' ', $this->display_name);

        return collect($nameFragments)
            ->map(fn (string $fragment) => Str::substr($fragment, 0, 1))
            ->join('');
    }
}
