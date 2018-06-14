<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\Dto\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $mail = new \Swift_Message('new contact', $contact->message);
            $mail->setFrom($contact->email, $contact->name);
            $mail->setTo('lyrixx@lyrixx.info');

            $this->get('mailer')->send($mail);

            $this->addFlash('success', 'thanks for your message.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
