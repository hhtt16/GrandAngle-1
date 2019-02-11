<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Collaborateur' => 'ROLE_USER'
                ]
            ])
            ->add('password', PasswordType::class)
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('photo', FileType::class, [
                'data_class' => null,
                'required' => false
            ])
            ->add('address', TextType::class)
            ->add('postal_code', TextType::class)
            ->add('city', TextType::class)
            ->add('birth_date', BirthdayType::class, [
                'format' => 'dd-MM-yyyy'
            ])
            ->add('phone', TextType::class, [
                'required' => false
            ])
            ->add('hire_date', DateType::class, [
                'format' => 'dd-MM-yyyy'
            ])
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
