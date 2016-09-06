<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login', TextType::class)
                ->add(
                    'plainPassword', RepeatedType::class, [
                        'type'           => PasswordType::class,
                        'first_options'  => ['label' => 'Password'],
                        'second_options' => ['label' => 'Repeat Password'],
                    ]
                )
                ->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('avatar', FileType::class)
                ->add(
                    'gender', RadioType::class, [
                        'choice' => [
                            'true'  => 'male',
                            'false' => 'female',
                        ],
                    ]
                );
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\User',
            ]
        );
    }


    public function getName()
    {
        return 'app_bundle_user_type';
    }
}
