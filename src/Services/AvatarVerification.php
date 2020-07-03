<?php

namespace App\Services;

use Symfony\Component\Config\Definition\Exception\Exception;


class AvatarVerification
{

   

    /**
     * @param User $user newUser or a user who want to delete his avatar
     * @return User user with a default avatar  
     */
    public function default($user)
    {
        
        $user->setAvatar('defaultAvatar.jpg'); 
        $user->setAvatarSize(27874); 

        return; 
       

    }

    /**
     * @param User $user who want to delete his avatar and have a default avatar
     * @return Exeption if user have a default avatar, else delete his avatar
     */
    public function alreadyDefault($user)
    {
        
        if ($user->getAvatar() === 'defaultAvatar.jpg') 
            {
                throw new Exception('La valeur n\'est pas bonne ;)');
                
            }
            else 
            {
                unlink("../public/uploads/user/avatar/" . $user->getAvatar()); 
                return;
            }
            
       

    }
    
    

    

    
}