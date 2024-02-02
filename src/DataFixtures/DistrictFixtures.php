<?php
namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use App\Entity;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DistrictFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $UtilisateurRepo = $manager->getRepository(Utilisateur::class);

        $cat1= new Categorie();
        $cat1
            ->setLibelle('Pasta')
            ->setImage('Pasta.jpg')
            ->setIsActive('1');
        $manager->persist($cat1);
        $cat2= new Categorie();
        $cat2 
            ->setLibelle('Pizza')
            ->setImage('Pizza.jpg')
            ->setIsActive('1');
        $manager->persist($cat2);
        $cat3=new Categorie();
        $cat3
            ->setLibelle('Burger')
            ->setImage('Burger.jpg')
            ->setIsActive('1');
        $manager->persist($cat3);

        $manager->flush();

        $plat1 = new Plat();
        $plat1
              ->setCategorie($cat1)
              ->setLibelle('Pâtes carbo')
              ->setDescription('Des pates carbobobobo')
              ->setPrix(8.5)
              ->setImage('pastabobo.jpg')
              ->setIsActive(1);
        $manager->persist($plat1);
        $plat2= new Plat();
        $plat2
              ->setCategorie($cat1)
              ->setLibelle('Pâtes bolo')
              ->setDescription('Beaux lolos')
              ->setPrix(8.5)
              ->setImage('Bolôlo.jpg')
              ->setIsActive(1);
        $manager->persist($plat2);
        $plat3= new Plat();
        $plat3
             ->setCategorie($cat2)
             ->setLibelle('Pizza kebab')
             ->setDescription('Salade, tomates, oignons.')
             ->setPrix(12.5)
             ->setImage('kebab.jpg')
             ->setIsActive(1);
        $manager->persist($plat3);
        $plat4 = new Plat();
        $plat4
              ->setCategorie($cat3)
              ->setLibelle('Putin Burger')
              ->setDescription('Puissance et pouvoir')
              ->setPrix(65.5)
              ->setImage('putin.jpg')
              ->setIsActive(1);
        $manager->persist($plat4);
        $plat5 = new Plat();
        $plat5
               ->setCategorie($cat3)
               ->setLibelle('Double Beef Burger')
               ->setDescription('DE LA VIANDE ET DE LA VIANDE ET DE LA VIANDE!!!!!!!!!')
               ->setPrix(12.5)
               ->setImage('double-beef.jpg')
               ->setIsActive(1);
        $manager->persist($plat5);
        
        
        $commande1=new Commande();
        $dt= new DateTime();
        $commande1
                 ->setDateCommande($dt)
                 ->setTotal(65.5)
                 ->setEtat(1);
                 $utilisateur1 = $UtilisateurRepo->find(1);
        $commande1->setUtilisateur($utilisateur1);
        $manager->persist($commande1);

        $commande2=new Commande();
        $commande2
                  ->setDateCommande($dt)
                  ->setTotal(65.5)
                  ->setEtat(1);
                  $utilisateur2 = $UtilisateurRepo->find(2);
                  $commande2->setUtilisateur($utilisateur2);
        $manager->persist($commande2);
        


        $manager->flush();





        /*foreach ($artist as $art){
            $artistDB = new Artist();
            $artistDB
            ->setId($art['artist_id'])
            ->setName($art['artist_name'])
            ->setUrl($art['artist_url']);

            $manager->persist($artistDB);

             // empêcher l'auto incrément
            $metadata = $manager->getClassMetaData(Artist::class);
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        }
        $manager->flush();

        foreach ($disc as $d) {
            $discDB = new Disc();
            $discDB
            ->setTitle($d['disc_title'])
            ->setLabel($d['disc_label'])
            ->setPicture($d['disc_picture']);
            $artist = $artistRepo->find($d['artist_id']);
            $discDB->setArtist($artist);
            $manager->persist($discDB);
        }

        $manager->flush();*/
    }
}

?>