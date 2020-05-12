<?php

namespace App\DataFixtures;

use Faker; 
use App\Entity\User;
use App\Entity\Vote;
use App\Entity\Article;
use App\Entity\Category;
use App\Services\Slugger;
use App\Entity\ListIngredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    private $slugger;

    public function __construct(UserPasswordEncoderInterface $encoder, Slugger $slugger)
    {
        $this->encoder = $encoder;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

         /* USERS */

         for ($i = 0; $i < 10; $i++) {

            $user = new User();
            
            if ($i === 0) 
            {
                $user->setUsername('UserTest');
                $user->setEmail('UserTest@usertest.com');
            }
            else 
            {
                $user->setUsername($faker->firstNameMale);
                $user->setEmail($faker->email); 
            } 

            $user->setSlug($this->slugger->sluggify($user->getViewUsername()));
            $user->setBirthDate($faker->datetime);
            $password = $this->encoder->encodePassword($user, 'faustine1');
            $user->setPassword($password);
            $user->setAvatar('img.jpg');
            $user->setCreatedAt($faker->datetime);
            $user->getRoles();

            $manager->persist($user);
        
            $this->addReference('user_'.$i, $user);

        }

        /* CATEGORY */
        
        $categoryNames =
        [
            "Recyclage" => [
                "recyclage.jpg",
                "#3a6617"
            ], 
            "Accessoires/bijoux" => [
                "accessoires-bijoux.jpg",
                "#683ad8"
            ], 
            "Décoration"  => [
                "decorations.jpg",
                "#2193d1"
            ], 
            "Cosmétiques / Beauté et Soins" => [
                "cosmetiques-beaute-et-soins.jpg",
                "#a48084"
            ],  
            "Hygiène corporelle" => [
                "hygiene-corporelle.jpg",
                "#fff5ad"
            ], 
            "Ménage/Hygiène maison"=> [
                "menage-hygiene-maison.jpg",
                "#b2d4dd"
            ],  
            "Bricolage" => [
                "bricolage.jpg",
                "#ed0021"
            ],  
            "Jardin/Jardinage" => [
                "jardin-jardinage.jpg",
                "#b0eb7d"
            ],  
            "Animaux" => [
                "animaux.jpg",
                "#484848"
            ],
            "Vêtements" => [
                "vetements.jpg",
                "#da7423"
            ],
            "Linge de maison" => [
                "linge-de-maison.jpg",
                "#e69cc2"
            ],
            "Arts" => [
                "arts.jpg",
                "#343f6d"
            ],
            "Jeux" => [
                "jeux.jpg",
                "#a2a2a2"
            ],
            
        ];

        $categories = []; 

        
        foreach ($categoryNames as $categoryName => $imageOrColor) {
            
            $category = new Category();
            $category->setName($categoryName);
            $category->setSlug($this->slugger->sluggify($category->getName()));
            $category->setColor($imageOrColor[1]); 
            $category->setPicture($imageOrColor[0]); 
            $category->setCreatedAt($faker->datetime);  
            
            $manager->persist($category); 

            // Add objet category in list of objet category
            $categories[] = $category; 
        }


        /* ARTICLE */

        for ($i = 0; $i < 40; $i++) {

            $article = new Article();

            if ($i === 0) {
                $article->setTitle('ArticleTest');
            }
            else 
            {
               $article->setTitle($faker->text(20)); 
            } 

            $article->setSlug($this->slugger->sluggify($article->getTitle()));
            $article->setSummary($faker->sentence);
            $article->setInstruction($faker->paragraph);
            $article->setCreatedAt($faker->datetime); 
            $article->setFlagged(0);
            
            
            // get between 1 and 13 categorie
            $articleCategories = $faker->randomElements($categories, random_int(1,12));

            /* Have all article in one category (for test pagination) => $articleCategories = $categories; */

            // for add in this article
            foreach($articleCategories as $articleCategory) {
                // get collection categories to this article and add the elements
                $article->setCategory($articleCategory);
            }
            
            // get reference user random
            $user = $this->getReference("user_" . random_int(1,9));

            // Add this user in this article
            $article->setUser($user);

            $manager->persist($article);

            $this->addReference('article_'.$i, $article);
        }

        /* ListIngredient */

        for ($i = 0; $i < 80; $i++) {

            $listIngredient = new ListIngredient();
            $disposition = $faker->randomDigit;
            $listIngredient->setDisposition($disposition); 
            $quantity = random_int(1,10);
            $listIngredient->setQuantity($quantity); 
            $listIngredient->setIngredient($faker->word);
            $listIngredient->setCreatedAt($faker->datetime); 
            
            // get Reference article random
            $article = $this->getReference("article_" . random_int(1,30)); 

            $listIngredient->setArticle($article); 

            // Add this article in this ingredient
            $article->setUser($user);

            $manager->persist($listIngredient);
            
        }

        /* VOTE */

        for ($i = 0; $i < 40; $i++) {

            $vote = new Vote(); 

            // get reference user random
            $user = $this->getReference("user_" . random_int(1,9));

            // get reference user random
            $article = $this->getReference("article_" . random_int(1,39));

            $vote->setUser($user); 
            $vote->setArticle($article); 
            $vote->setVoteValue(random_int(1,5));
            $vote->setCreatedAt($faker->datetime); 
          
            $manager->persist($vote);
        }



        // $manager->persist($product);

        $manager->flush();
    }
}
