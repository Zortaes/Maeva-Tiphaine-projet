<?php

namespace App\Services;


class AvatarVerification
{

   

    /**
     * @param User $newUser 
     * @return User newUser with an avatar default 
     */
    public function default($newUser)
    {
        
        $newUser->setAvatar('defaultAvatar.jpg'); 
        $newUser->setAvatarSize(27874); 

        return; 
       

    }
    
    

    

    
}