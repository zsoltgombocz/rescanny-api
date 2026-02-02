<?php

namespace App\Domains\User\Actions;

use App\Models\User;
use Laravel\Cashier\Exceptions\CustomerAlreadyCreated;
use Laravel\Cashier\Exceptions\IncompletePayment;

class CreateUserAction
{
    /**
     * @throws CustomerAlreadyCreated
     * @throws IncompletePayment
     */
    public function handle(string $email): ?User
    {
        $user = User::query()
            ->create([
                'email' => $email,
                'locale' => app()->getLocale(),
            ])->fresh();

        // $user->createAsStripeCustomer();

        // $user->newSubscription('default', SubscriptionPlan::Free->getPriceId())->create();

        return $user;
    }
}
