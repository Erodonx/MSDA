<?php
namespace App\Service;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Plat;

class PanierService
{

    private $item;
    private $quantite;
    //On injecte dans le constructeur le MailerInterface

    public function __construct(plat $item, int $quantite){
        $this->item = $item;
        $this->quantite=$quantite;
    }

//...
public function ajoutPanier(plat $item,int $quantite)
{

}
}


?>