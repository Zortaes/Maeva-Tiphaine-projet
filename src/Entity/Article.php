<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ListIngredient;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @UniqueEntity("title", message="Ce titre existe déjà, veuillez en choisir un autre")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=160)
     * @Assert\NotBlank
     */
    private $summary;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $instruction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

     /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="image", size="imageSize")
     * @var File|null
     */
    private $articleImageFile;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $flagged;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ListIngredient", mappedBy="article", cascade={"persist","remove"})
     * @ORM\OrderBy({"disposition" = "ASC"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="article", cascade={"remove"})
     */
    private $votes;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flag", mappedBy="article", cascade={"remove"})
     */
    private $flags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="articles")
     */
    private $categories;


    public function __construct() 
    {
        $this->ingredients = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->flags = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

   
    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of summary
     */ 
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @return  self
     */ 
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get the value of instruction
     */ 
    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    /**
     * Set the value of instruction
     *
     * @return  self
     */ 
    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * Get the value of articleImage
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

     /**
     * Get the value of imageSize
     *
     * @return  int|null
     */ 
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set the value of imageSize
     *
     * @param  int|null  $imageSize
     *
     * @return  self
     */ 
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  File|null
     */ 
    public function getArticleImageFile()
    {
        return $this->articleImageFile;
    }

    /**
     * Set nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @param  File|null  $articleImageFile  NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  self
     */ 
    public function setArticleImageFile($articleImageFile)
    {
        $this->articleImageFile = $articleImageFile;

        return $this;
    }
    
    /**
     * Get the value of flagged
     *
     * @return  self
     */ 
    public function getFlagged(): ?bool
    {
        return $this->flagged;
    }

        /**
     * Set the value of flagged
     *
     * @return  self
     */ 
    public function setFlagged(bool $flagged): self
    {
        $this->flagged = $flagged;

        return $this;
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
     * Get the value of created_at
     */ 
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /***********
    RELATIONSHIP
    ***********/

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
     * Get oRM/OneToMany(targetEntity="App/Entity/ListIngredient", mappedBy="article")
     */ 
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set the value of ingredients
     *
     * @return  self
     */ 
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function addIngredient(ListIngredient $listIngredient)
    {
        $this->ingredients->add($listIngredient);
    }

    public function removeIngredient(ListIngredient $listIngredient)
    {
        $this->ingredients->removeElement($listIngredient);
    }

    /**
     * Get the value of votes
     */ 
    public function getVotes()
    {
        return $this->votes;
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
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * Set the value of categories
     *
     * @return  self
     */ 
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category)
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }



}
