<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo', FileType::class,[
                'data_class' => null
            ])
            ->add('email')
            ->add('roles', ChoiceType::class,[
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Collaborateur' => 'ROLE_USER'
                    ]
                ])
            ->add('password', HiddenType::class)
            ->add('lastname')
            ->add('firstname')
            ->add('address')
            ->add('postal_code')
            ->add('city')
            ->add('birth_date')
            ->add('phone')
            ->add('hire_date')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms'
        ]);
    }
}
