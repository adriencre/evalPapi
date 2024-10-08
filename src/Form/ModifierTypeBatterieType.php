<?php
// src/Form/ModifierTypeBatterieType.php

namespace App\Form;

use App\Entity\TypeBatterie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifierTypeBatterieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, ['attr' => ['class'=> 'form-control'], 'label' => 'Référence'])
            ->add('capacite', IntegerType::class, ['attr' => ['class'=> 'form-control'], 'label' => 'Capacité en Watts'])
            ->add('pays', TextType::class, ['attr' => ['class'=> 'form-control'], 'label' => 'Pays'])
            ->add('modifier', SubmitType::class, ['attr' => ['class'=> 'btn btn-primary mt-4']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeBatterie::class,
        ]);
    }
}
