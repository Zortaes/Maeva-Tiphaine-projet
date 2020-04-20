<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testArticleDetails()
    {
        
        $client = static::createClient();
     
        $client->request('GET', '/article/ArticleTest');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode()); 

       
         /* check if we are in the article Details  */
         $this->assertSelectorTextContains(
            "html title", 
            "ArticleTest", 
            "Title of page is no correct, ArticleTest in ArticleControllerTest Failed"
        );

        $crawler = $client->getCrawler();

        /* select and click of the button to vote */
        $form = $crawler->selectButton("mediocre")->form(); 

        $crawler = $client->submit($form);

        $client->followRedirects();
  
        $this->assertEquals(
            302,
            $client->getResponse()->getStatusCode()
        );

        $client->followRedirect();

        $this->assertEquals(
            "http://localhost/connexion",
            $client->getRequest()->getUri()
        );

        /* check if we are in the page login  */
        $this->assertSelectorTextContains(
            "html title", 
            "Connexion", 
            "Le titre de la page n'est pas correct"
        );
        
        
    }
}
