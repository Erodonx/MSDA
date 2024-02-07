<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Detail;
use App\Entity\Plat;
use App\Repository\PlatRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CommandeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\Date;


class CommandeController extends AbstractController
{   
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $em, SessionInterface $session, PlatRepository $platRepo){

        if ($this->getUser()==null)
        {
            $this->addFlash('success' , 'Veuillez vous authentifiez pour commander.');
            return $this-> redirectToRoute('app_accueil');
        }
        $panier = $session->get('panier', []);
        if ($panier === [])
        {
         $this->addFlash('success' , 'Votre panier est vide');
         return $this-> redirectToRoute('app_accueil');
        }
        $form = $this->createForm(CommandeType::class);
        $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid())
    {
        
       
        $total = 0;
        $commande = new Commande();
        $commande->setUtilisateur($this->getUser());
        foreach($panier as $item => $quantite)
        {
            $detail = new Detail;
            $plat = $platRepo->find($item);

            $detail->setPlat($plat);
            $detail->setQuantite($quantite);
            $commande->addDetail($detail);
            $total+=($plat->getPrix()*$quantite);
        }
        $commande->setTotal($total); 
        $commande->setAdresseFacturation($form->get('Adresse_facturation')->getData());
        $commande->setAdresseLivraison($form->get('Adresse_livraison')->getData());
        $commande->setMethodePaiement($form->get('Methode_paiement')->getData());
        $date = new DateTime();
        $commande->setDateCommande($date);
        $commande->setEtat('1');

        $em->persist($commande);
        $em->flush();

        $session->remove('panier');
        return $this->render('accueil/index.html.twig');
        
    }
    return $this->render('commande/index.html.twig', [
        'commandeForm' => $form->createView(),
    ]);
}
}