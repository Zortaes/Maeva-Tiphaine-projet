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
     * @return subject of the email
     */
    public function subjectPassword()
    {
        return 'Récupération de votre mot de passe sur La rubrique écolo';
    }

    /**
     * @return $random token generate for the signup
     */
    public function tokenSignup()
    {
        
        $random = bin2hex(openssl_random_pseudo_bytes(64));

        return $random; 

    }

     /**
     * @return $numberRandom generate for the lost password
     */
    public function numberRandomCode()
    {
        $numberRandom1 = rand(0, 9); 
        $numberRandom2 = rand(0, 9); 
        $numberRandom3 = rand(0, 9); 
        $numberRandom4 = rand(0, 9); 
        $numberRandom5 = rand(0, 9); 

        $numberRandom = $numberRandom1 . $numberRandom2 . $numberRandom3 . $numberRandom4 . $numberRandom5;

        return $numberRandom; 
    }

    
}