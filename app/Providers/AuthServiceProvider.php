<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Aquí van tus modelos y policies
        \App\Models\Contacto::class => \App\Policies\deleteContactos::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Aquí podés registrar Gates si querés
    }
}
