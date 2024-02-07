<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
    ->add('objet', TextType::class, [
        'attr' => [
            'class' => 'form-control',
            'minlenght' => '2',
            'maxlenght' => '100',
        ],
        'label' => 'Sujet',
        'label_attr' => [
            'class' => 'form-label  mt-4'
        ],
        'constraints' => [
            new Assert\Length(['min' => 2, 'max' => 100])
        ]
    ])
    ->add('email', EmailType::class, [
        'attr' => [
            'class' => 'form-control',
            'minlenght' => '2',
            'maxlenght' => '180',
        ],
        'label' => 'Adresse email',
        'label_attr' => [
            'class' => 'form-label  mt-4'
        ],
        'constraints' => [
            new Assert\NotBlank(),
            new Assert\Email(),
            new Assert\Length(['min' => 2, 'max' => 180])
        ]
    ])

    //On a rajouté un label et on a rendu le champ optionnel en
    // donnant la valeur false à l'attribut required
    ->add('message', TextareaType::class, [
        'attr' => [
            'class' => 'form-control',
        ],
        'label' => 'Description',
        'label_attr' => [
            'class' => 'form-label mt-4'
        ],
        'constraints' => [
            new Assert\NotBlank()
        ]
    ])
    ->add('save', SubmitType::class, [
        'attr' => [
            'class' => 'btn btn-secondary mt-4'
        ],
        'label' => 'Soumettre ma demande'
    ]);
}



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Options par défaut pour le formulaire
            'data_class' => Contact::class,
        ]);
    }
}