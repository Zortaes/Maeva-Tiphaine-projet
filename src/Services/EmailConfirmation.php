<?php

namespace App\Services;


class EmailConfirmation
{

    public function subject()
    {
        return 'Création de votre compte sur La rubrique écolo';
    }

    public function tokenSignup()
    {
        
        $random = bin2hex(openssl_random_pseudo_bytes(64));

        return $random; 

    }

    
}