<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\DiscRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $artistRepo;
    private $discRepo;
    private $em;

    /*public function __construct(ArtistRepository $artistRepo, DiscRepository $discRepo, EntityManagerInterface $em)
    {
        $this->artistRepo = $artistRepo;
        $this->discRepo = $discRepo;
        $this->em = $em;

    }*/
    #[Route('/accueil', name: 'app_accueil')]
    public function index()
    {
       //on appelle le repository pour accéder à la fonction
       echo('salut');

        //on teste le contenu de la variable $artistes : dd() veut dire Dump and Die
       /* dd($artistes); */

     // ...    

    }

}