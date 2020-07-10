<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;


class FeedbackVoter extends Voter
{

    private $security;


    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'DELETE'])
            && $subject instanceof \App\Entity\Feedback;
    }

    
    protected function voteOnAttribute($attribute, $feedback, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) 
        {
            return false;
        }

        if(null == $feedback->getUser())
        {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) 
        {
            return true;
        }
        
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                return  $feedback->getUser()->getId() == $user->getId();
                break;

            case 'DELETE':
                return  $feedback->getUser()->getId() == $user->getId();
                break;
        }

        return false;
    }
}
