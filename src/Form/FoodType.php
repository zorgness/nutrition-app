<?php

namespace App\Form;

use App\Entity\Food;
use PHPUnit\TextUI\XmlConfiguration\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('imageFile', FileType::class, ['required' => false])
            ->add('calorie')
            ->add('protein')
            ->add('carbohydrates')
            ->add('lipids')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Food::class,
        ]);
    }
}
