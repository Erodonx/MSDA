<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Utilisateur;
use App\Form\DemoFormType;
use App\Form\ContactFormType;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
//use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    //#[isGranted('ROLE_CLIENT', message: "Nous sommes désolés, vous ne disposez pas des autorisations nécessaires pour accèder à cette page!")]
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailService $ms, ): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //on crée une instance de Contact
            // $message = new Contact();
            // Traitement des données du formulaire
            $message = $form->getData();
            //on stocke les données récupérées dans la variable $message
            // $message = $data;

            $entityManager->persist($message);
            $entityManager->flush();
            //envoi de mail avec notre service MailService
           // $email = $ms->sendMail( 'admin@velvet.com', $message->getEmail(), $message->getObjet(), $message->getMessage() );
//            dd($message->getEmail());
return $this->redirect("/");
        }


        return $this->render('contact/index.html.twig', [
//            'form' => $form->createView(),
              'form' => $form
        ]);
    }
}