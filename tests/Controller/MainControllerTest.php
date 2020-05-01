<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testHomepageLinkArticleDetails()
    {
        
        $client = static::createClient();

        $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode()); 

        /* check if we are in the Homepage */
        $this->assertSelectorTextContains('html h1.title-image-flowers', 'Bienvenue sur La rubrique écolo');

        $crawler = $client->getCrawler();
        
            
        /* count the number of link Article Details */
        $this->assertCount(
            14, 
            $crawler->filter("h4.card-title-custum a"),  
            "article details does not exist or the count is no correct"
        );
        
        /* select and click of the link Article Details */
        $linkArticleDetails = $crawler->filter("h4.card-title-custum a")->link();
        $client->click($linkArticleDetails);

        $responseafter = $client->getResponse();
        
        $this->assertEquals(200, $responseafter->getStatusCode()); 

         /* check if we are in the article Details (test link for Article Details) */
         $this->assertSelectorTextContains(
            "html button.bg-white", 
            "...", 
            "You are not in the page article Details"
        );

      
        
    }

    public function testHomepageLinkCategories()
    {
        
        $client = static::createClient();

        $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode()); 

        /* check if we are in the Homepage */
        $this->assertSelectorTextContains('html h1.title-image-flowers', 'Bienvenue sur La rubrique écolo');

        $crawler = $client->getCrawler();
        
        /* select and click of the link Categorie Details */
        $linkCategorieDetails = $crawler->filter("div.show a")->link();
        $client->click($linkCategorieDetails);

        $responseafter = $client->getResponse();
        
        $this->assertEquals(200, $responseafter->getStatusCode()); 

         /* check if we are in the article Details (test link for Categorie Details) */
         $this->assertSelectorTextContains(
            "p.category-title-p", 
            "Recyclage", 
            "You are not in the page category Details"
        );
        
         

      
        
    }
}
