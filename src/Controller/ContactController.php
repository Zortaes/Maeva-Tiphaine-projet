<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Type\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function sendEmail(MailerInterface $mailer, Request $request)
    {

        $contact = new Contact();

        $formContact = $this->createForm(ContactType::class, $contact);  
        $formContact->handleRequest($request);


        if ($formContact->isSubmitted() && $formContact->isValid()) 
        {
            $sender = $formContact('email')->getdata();
            $title = $formContact('title')->getdata();
            $message = $formContact('message')->getdata();

            $email = (new Email())
                ->from($sender)
                ->to('la.rubrique.ecolo@gmail.com')
                ->subject($title)
                ->text($message);

            $mailer->send($email);

            
            $contact->setEmail($sender); 
            $contact->setTitle($title);
            $contact->setMessage($message);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash("success", "Nous avons bien reçu votre email, nous traîtons votre demande, merci de votre patience");
            return $this->redirectToRoute('homepage');
            
        }

        return $this->render('/contact/contact.html.twig', 
            [ 
                'form' => $formContact->createView(), 
            ]);
    }
}