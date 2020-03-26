<?php

namespace App\DataFixtures;

use Faker; 
use App\Entity\User;
use App\Entity\Vote;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\ListIngredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

         /* USERS */

         for ($i = 0; $i < 10; $i++) {
    
            $user = new User();
            $user->setUsername($faker->name);
            $user->setBirthDate($faker->datetime);
            $user->setEmail($faker->email);
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
            "Recyclage", 
            "Accessoires/bijoux", 
            "Décoration", 
            "Cosmétiques / Beauté et Soins", 
            "Hygiène corporelle", 
            "Ménage/Hygiène maison", 
            "Bricolage",
            "Jardin/Jardinage",
            "Animaux",
            "Vêtements",
            "Linge de maison",
            "Arts",
            "Jeux",
            
        ];

        $categories = []; 

        
        foreach ($categoryNames as $categoryName) {
            
            $category = new Category();
            $category->setName($categoryName);
            $category->setColor($faker->hexcolor); 
            $category->setPicture('image.jpg'); 
            $category->setCreatedAt($faker->datetime);  
            
            $manager->persist($category); 

            // Add objet category in list of objet category
            $categories[] = $category; 
        }


        /* ARTICLE */

        for ($i = 0; $i < 40; $i++) {

            $article = new Article();
            $article->setTitle($faker->country);
            $article->setSummary($faker->sentence);
            $article->setInstruction($faker->paragraph);
            $article->setCreatedAt($faker->datetime); 
            $article->setFlagged(0);
            
            
            // get between 1 and 13 categorie
            $articleCategories = $faker->randomElements($categories, random_int(1,12));

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
