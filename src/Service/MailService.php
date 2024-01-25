<?php
namespace App\Service;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{

    private $mailer;
    private $paramBag;
    //On injecte dans le constructeur le MailerInterface

    public function __construct(MailerInterface $mailer, ParameterBagInterface $paramBag){
        $this->mailer = $mailer;
        $this->paramBag = $paramBag;
    }

//...
public function sendMail($expediteur,$destinataire,$sujet,$message)
{

$email = (new TemplatedEmail())
->from($expediteur)
//            ->to('you@example.com')
->to(new Address($destinataire))
//->cc('cc@example.com')
//->bcc('bcc@example.com')
//->replyTo('fabien@example.com')
//->priority(Email::PRIORITY_HIGH)
->subject($sujet)

// le chemin de la vue Twig à utiliser dans le mail
->htmlTemplate('emails/contact_email.html.twig')

// un tableau de variable à passer à la vue; 
//  on choisit le nom d'une variable pour la vue et on lui attribue une valeur (comme dans la fonction `render`) :
->context([
        'expiration_date' => new \DateTime('+7 days'),
        'username' => 'foo',
         'user' => $expediteur,
        'objet' => $sujet,
        'message' => $message
    ]);

$this->mailer->send($email);


// ...
}
}


?>