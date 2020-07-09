<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $flaggedUp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


/***********
RELATIONSHIP 
***********/
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="feedback")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="feedback")
     */
    private $article;


/****************
SETTERS & GETTERS  
****************/

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of flaggedUp
     */ 
    public function getFlaggedUp()
    {
        return $this->flaggedUp;
    }

    /**
     * Set the value of flaggedUp
     *
     * @return  self
     */ 
    public function setFlaggedUp($flaggedUp)
    {
        $this->flaggedUp = $flaggedUp;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of article
     */ 
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the value of article
     *
     * @return  self
     */ 
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

}