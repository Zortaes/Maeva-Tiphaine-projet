<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    
    public function testLoginRedirectFromArticleNew()
    {

        $client = static::createClient();
        
        // Starting from article/nouveau
        $client->request('GET', '/article/nouveau');

        // Anonymous are being redirected to login
        $client->followRedirects();

        $response = $client->getResponse();

        $this->assertEquals(302, $response->getStatusCode()); 

        $client->followRedirect();

        /* check if we are in the page login  */
        $this->assertSelectorTextContains
        (
            "html title", 
            "Connexion", 
            "Le titre de la page n'est pas correct"
        );

        $crawler = $client->getCrawler();

        // select submit button from form connexion
        $form = $crawler->selectButton("Continuer")->form();

        // enter correct information
        $form['email'] = "UserTest@usertest.com";
        $form['password'] = "faustine1";

        // submit form
        $crawler = $client->submit($form);

        // come back to previous page after authentication, check it
        $this->assertCount(
            1,
            $crawler->filter("h1:contains('Ajouter un article')")
        );

    }
}