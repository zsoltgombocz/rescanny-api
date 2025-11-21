<?php

namespace App\Middlewares;

use App\Domains\Localization\SupportedLocalesRepository;
use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var ?User $user */
        $user = Auth::guard('web')->user();
        $acceptLanguage = $request->getPreferredLanguage();
        $localesRepository = resolve(SupportedLocalesRepository::class);

        $headerLocale = $localesRepository->isValidLocale($acceptLanguage) ? $acceptLanguage : 'en';

        app()->setLocale($user ? $user->preferredLocale() : $headerLocale);

        return $next($request);
    }
}
