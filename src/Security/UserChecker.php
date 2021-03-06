<?php

namespace App\Security;


use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if ($user->getIsBanned()) {
            throw new CustomUserMessageAuthenticationException('Ce compte a été banni pour cause de publication inappropriée, cependant il vous est possible de nous contacter via la rubrique "Nous contacter"');
   
        }
    }
}