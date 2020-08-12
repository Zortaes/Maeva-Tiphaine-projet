<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username", message="Ce nom d'utilisateur existe déjà")
 * @UniqueEntity("email", message="Cet email est déjà utilisé")
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", length=55, unique=true)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $avatar;

    /**
    * NOTE: This is not a mapped field of entity metadata, just a simple property.
    * 
    * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="avatar", size="avatarSize")
    * 
    * @var File|null
    */
    private $avatarFile;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $avatarSize;

     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="date", nullable=true)
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
     * @ORM\Column(type="boolean")
     */
    private $validateLostPassword;


/***********
RELATIONSHIP 
***********/

    /**
     * ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user", cascade={"remove"})
     */
    private $articles;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="user", cascade={"remove"})
    */
    private $votes;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Flag", mappedBy="user", cascade={"remove"})
    */
    private $flags;

    /**
     * ORM\OneToMany(targetEntity="App\Entity\Feedback", mappedBy="user", cascade={"remove"})
     */
    private $feedback;


    public function __construct() 
    {
        $this->is_banned = false;
        $this->validate = false; 
        $this->validateLostPassword = false; 
        $this->articles = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->flags = new ArrayCollection();
        $this->feedback = new ArrayCollection();
    }


/****************
SETTERS & GETTERS  
****************/

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
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar; 

    }

    /**
     * Get the value of avatarSize
     *
     * @return  int|null
     */ 
    public function getAvatarSize()
    {
        return $this->avatarSize;
    }

    /**
     * Set the value of avatarSize
     *
     * @param  int|null  $avatarSize
     *
     * @return  self
     */ 
    public function setAvatarSize($avatarSize)
    {
        $this->avatarSize = $avatarSize;

        return $this;
    }

    /**
     * Get nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  File|null
     */ 
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * Set nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @param  File|null  $avatarFile  NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  self
     */ 
    public function setAvatarFile($avatarFile)
    {
        $this->avatarFile = $avatarFile;

        return $this;
    }

    /**
     * Get the value of flags
     */ 
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set the value of flags
     *
     * @return  self
     */ 
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * Get oRM\OneToMany(targetEntity="App\Entity\Feedback", mappedBy="user", cascade={"remove"})
     */ 
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of validateLostPassword
     */ 
    public function getValidateLostPassword()
    {
        return $this->validateLostPassword;
    }

    /**
     * Set the value of validateLostPassword
     *
     * @return  self
     */ 
    public function setValidateLostPassword($validateLostPassword)
    {
        $this->validateLostPassword = $validateLostPassword;

        return $this;
    }


}
