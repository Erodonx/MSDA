<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PlatRepository;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{
    private $platRepo;
    private $categorieRepo;
    public function __construct(PlatRepository $platRepo, CategorieRepository $categorieRepo)
    {
        $this->platRepo = $platRepo;
        $this->categorieRepo = $categorieRepo;
    }
    #[Route('/plats', name: 'app_plats')]
    public function index(): Response
    {
     $plats = $this->platRepo->findAll();   
     $categories = $this->categorieRepo->findAll();
        return $this->render('plats/index.html.twig', [
            'controller_name' => 'PlatsController',
            'plats' => $plats,
            'categories' => $categories
        ]);
    }
    #[Route('/plats/{categorie_id}', name: 'app_plats_cat')]
    public function show(int $categorie_id) : Response
    {
        $categorie = $this->categorieRepo->find($categorie_id);

        return $this->render('plats/index.html.twig', [
            'controller_name' => 'PlatsController',
            'plats' => $this->platRepo->findBy(['categorie' => $categorie])]);
    }
}
