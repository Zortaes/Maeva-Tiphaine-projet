<?php

namespace App\Services;


class EmailConfirmation
{

    /**
     * @return subject of the email
     */
    public function subject()
    {
        return 'Création de votre compte sur La rubrique écolo';
    }

    /**
     * @return $random token generate for the signup
     */
    public function tokenSignup()
    {
        
        $random = bin2hex(openssl_random_pseudo_bytes(64));

        return $random; 

    }

    
}