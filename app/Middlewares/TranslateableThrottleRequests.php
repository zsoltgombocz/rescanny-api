<?php

namespace App\Middlewares;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Middleware\ThrottleRequests;

class TranslateableThrottleRequests extends ThrottleRequests
{
    /**
     * Create a 'too many attempts' exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key
     * @param  int  $maxAttempts
     * @param  callable|null  $responseCallback
     * @return \Illuminate\Http\Exceptions\ThrottleRequestsException|\Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function buildException($request, $key, $maxAttempts, $responseCallback = null)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);

        $headers = $this->getHeaders(
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter),
            $retryAfter
        );

        // Use Laravel's trans() helper to translate the error message
        $errorMessage = __('throttle.message', ['seconds' => $retryAfter]);

        return is_callable($responseCallback)
            ? $responseCallback($request, $headers)
            : new ThrottleRequestsException($errorMessage, null, $headers);
    }
}
