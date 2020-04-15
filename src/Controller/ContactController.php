<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Type\ContactType;
use DateTime;
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
            $sender = $formContact->get('email')->getdata();
            $title = $formContact->get('title')->getdata();
            $message = $formContact->get('message')->getdata();

            
            $contact->setCreatedAt(new DateTime('now'));

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();


            $email = (new Email())
                ->from($sender)
                ->to('la.rubrique.ecolo@gmail.com')
                ->subject($title)
                ->text($message);

            $mailer->send($email);


            $this->addFlash("success", "Nous avons bien reçu votre email, nous traîtons votre demande, merci de votre patience");
            return $this->redirectToRoute('homepage');
            
        }

        return $this->render('/contact/contact.html.twig', 
            [ 
                'form' => $formContact->createView(), 
            ]);
    }
}