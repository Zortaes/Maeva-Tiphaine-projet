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

    public function message($id, $token)
    {
        return "

        <h3>Création de votre compte sur La rubrique écolo</h3>

        <strong>Bienvenue sur le site La rubrique écolo</strong>

        <p>Merci de nous rejoindre. Cet espace vous permettra de participer activement à la communauté du site.<p>
        <p>Pour activer votre compte et valider définitivement votre inscription, cliquez sur le lien çi dessous.</p>
        <p>Ce lien ne fonctionne pas ?</p>
        <p>Copiez celui-ci dans la barre d'adresse de votre navigateur :</p>

        <p>http://127.0.0.1:8001/" . $id . "/" . $token ."/validation</p>

        <p>L'équipe La rubrique écolo</p>
        
        ";
    }
}