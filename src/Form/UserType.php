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
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo', FileType::class,[
                'data_class' => null,
                'required' => false,
                'mapped' => false
                ])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Entrez pour changer'
                ]
            ]
            )
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('address', TextType::class)
            ->add('postal_code', TextType::class)
            ->add('city', TextType::class)
            ->add('phone', TextType::class, [
                'required' => false
            ])
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
