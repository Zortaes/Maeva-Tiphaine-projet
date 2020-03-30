<?php

namespace App\Services;

use Symfony\Component\String\Slugger\SluggerInterface;

class Slugger
{

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function sluggify($str)
    {
        $slug = $this->slugger->slug($str);

        return $slug;
    }
}