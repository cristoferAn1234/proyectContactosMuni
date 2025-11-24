<?php

namespace App\Policies;

use App\Models\Contacto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class deleteContactos
{

    public function deleteContactos(User $user, Contacto $contacto): bool
    {
      
        return $user->role === 'admin'; 
    }

   
}
