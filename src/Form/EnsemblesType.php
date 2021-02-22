<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Ensembles;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EnsemblesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'required' => true,
                'allow_delete' => false,
            ])
            ->add('produits', CollectionType::class, [
                'entry_type' => ProduitsType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true
            ])
            ->add('Budget',EntityType::class, [
                // looks for choices from this entity
                'class' => Budget::class,
            
                // uses the Saisons.nom property as the visible option string
                'choice_label' => function ($Budget) {
                    return $Budget->getnom();
                },
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ensembles::class,
        ]);
    }
}
