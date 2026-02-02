<?php

namespace App\Http\Requests;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class RequestEmailChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = Auth::user();

        return [
            'new_email' => 'required|email|unique:users,email,'.$user->id,
        ];
    }
}
