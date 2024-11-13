<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class)
            ->add('modele', TextType::class)
            ->add('image', TextType::class)
            ->add('km', IntegerType::class)
            ->add('prix', NumberType::class)
            ->add('nombreProprietaires', IntegerType::class)
            ->add('cylindree', TextType::class)
            ->add('puissance', TextType::class)
            ->add('carburant', TextType::class)
            ->add('anneeMiseEnCirculation', IntegerType::class)
            ->add('transmission', TextType::class)
            ->add('description', TextareaType::class)
            ->add('options', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}