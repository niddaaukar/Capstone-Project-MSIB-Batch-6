<?php

namespace App\Providers;

use App\Models\Booking;
use App\Policies\BookingPolicy;
use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Booking::class => BookingPolicy::class,
        User::class => AdminPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
