<?php

namespace App\EventSubscriber;

use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\Utilisateur;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CommandeSubscriber implements EventSubscriber
{
    private $mailer;
    private $UtilisateurRepo;
    private $PlatRepo;
    private $DetailRepo;
    private $CommandeRepo;
    public function __construct(MailerInterface $mailer, UtilisateurRepository $UtilisateurRepo, DetailRepository $DetailRepo, PlatRepository $PlatRepo, CommandeRepository $CommandeRepo)
    {
        $this->mailer = $mailer;
        $this->UtilisateurRepo = $UtilisateurRepo;
        $this->DetailRepo = $DetailRepo;
        $this->PlatRepo = $PlatRepo;
        $this->CommandeRepo = $CommandeRepo;
    }

    public function getSubscribedEvents()
    {
        //retourne un tableau d'événements (prePersist, postPersist, preUpdate etc...)
        return [
            //événement déclenché après l'insert dans la base de donnée
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
//        $args->getObject() nous retourne l'entité concernée par l'événement postPersist
        $entity = $args->getObject();

//     Vérifier si l'entité est un nouvel objet de type Contact;
//    Si l'objet persité n'est pas de type Contact, on ne veut pas que le Subscriber se déclenche!
        if ($entity instanceof \App\Entity\Commande) {

            
            $objet = $entity->__toStringCommande();
            $message = $entity->__toString();
            
            $Utilisateur = $this->UtilisateurRepo->find($entity->getUtilisateur());
         

                $email = (new Email())
                    ->from('admin@velvet.com')
                    ->to($Utilisateur->getEmail())
                    ->subject($objet)
                    ->text($message);

                $this->mailer->send($email);
            }

        }
    }