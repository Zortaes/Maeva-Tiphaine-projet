<?php

namespace App\Security;


use App\Entity\User as AppUser;
use Exception;
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
            throw new \Exception('Ce compte a été banni pour cause de contenu inapproprié');
   
        }
    }
}