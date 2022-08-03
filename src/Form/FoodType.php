<?php

namespace App\Form;

use App\Entity\Food;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use PHPUnit\TextUI\XmlConfiguration\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('imageFile', FileType::class, ['required' => false])
            ->add('type', EntityType::class, ['class' => Type::class,
            'choice_label' => 'label'])
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
