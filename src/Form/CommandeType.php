<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Adresse_livraison' ,TextType::class ,['label' => 'Adresse de livraison'])
            ->add('Adresse_facturation',TextType::class ,['label' => 'Adresse de facturation'])
            ->add('Methode_paiement', ChoiceType::class ,['label' => 'Méthode de paiement', 'choices' => [
                'Veuillez selectionnez le mode de paiement ci-dessous :' =>null,
                'VISA' => 'VISA',
                'PAYPAL' => 'PAYPAL',
                'LA CARTE DE MAMAN' => 'LA CARTE DE MAMAN'
            ]])
            ->add('CGU_validation',  CheckboxType::class,['label' => 'J\'accepte les conditions générales d\'utilisation' , 'mapped' => false] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
