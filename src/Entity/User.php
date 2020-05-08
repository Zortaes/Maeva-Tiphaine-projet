<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username", message="Ce nom d'utilisateur existe déjà")
 * @UniqueEntity("email", message="Cet email est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $facebook_id;

    /**
     * @ORM\Column(type="string", length=16, unique=true)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank
     */
    private $birth_date;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_banned;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $validation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

    /**
     * ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user", cascade={"remove"})
     */
    private $articles;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="user", cascade={"remove"})
    */
    private $votes;

    public function __construct() 
    {
        $this->is_banned = false;
        $this->validate = false; 
        $this->articles = new ArrayCollection();
        $this->votes = new ArrayCollection();
        
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */ 
    public function getViewUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
   
    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of birth_date
     */ 
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Set the value of birth_date
     *
     * @return  self
     */ 
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get oRM/OneToMany(targetEntity="App/Entity/Article", mappedBy="user")
     */ 
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Get the value of votes
     */ 
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of is_banned
     */ 
    public function getIsBanned()
    {
        return $this->is_banned;
    }

    /**
     * Set the value of is_banned
     *
     * @return  self
     */ 
    public function setIsBanned($is_banned)
    {
        $this->is_banned = $is_banned;

        return $this;
    }

    /**
     * Get the value of validation
     */ 
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set the value of validation
     *
     * @return  self
     */ 
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get the value of validate
     */ 
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * Set the value of validate
     *
     * @return  self
     */ 
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get the value of facebook_id
     */ 
    public function getFacebook_id()
    {
        return $this->facebook_id;
    }

    /**
     * Set the value of facebook_id
     *
     * @return  self
     */ 
    public function setFacebook_id($facebook_id)
    {
        $this->facebook_id = $facebook_id;

        return $this;
    }
}
